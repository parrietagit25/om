<?php
session_start();
include('conf/conn.php');

require 'vendor/autoload.php';  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use setasign\Fpdi\Fpdi;  
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;

$codigo = bin2hex(random_bytes(10));  
$monto_total = $_POST['cantidad'] * $_POST['precio'];
$insert = $conn->query("INSERT INTO ventas(id_product, id_user, cantidad, monto, monto_total, stat, codigo_promo)
                        VALUES
                        ('".$_POST['id_producto']."', '".$_SESSION['user_id']."', '".$_POST['cantidad']."', '".$_POST['precio']."', '".$monto_total."', 1, '".$codigo."')");

if ($insert) {
    echo 'Insertado con éxito';

    $usuario = select_datos_id("users_om", $conn, " id = '".$_SESSION['user_id']."'");
    foreach ($usuario as $key => $value) {
        $nombre_completo = $value['nombre']. ' ' . $value['apellido'];
        $email = $value['email'];
    }

    $qrCode = QrCode::create($codigo)
        ->setSize(300)
        ->setMargin(10)
        ->setEncoding(new Encoding('UTF-8'));  
    $writer = new PngWriter();
    $qrCodeImage = $writer->write($qrCode);

    $qrCodeFile = 'temp_qr.png';
    $qrCodeImage->saveToFile($qrCodeFile);

    $pdf = new Fpdi();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Aquí está su código QR:');
    $pdf->Ln(20);
    $pdf->Image($qrCodeFile, 10, 30, 100, 100); 
    $pdfFile = 'codigo_qr.pdf';
    $pdf->Output('F', $pdfFile); 

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tayronperez17@gmail.com';  
        $mail->Password = '';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;//wvwwiwnxmdeqssbi
        $mail->Port = 587;

        $mail->setFrom('ofertasymas@ofmptygroup.com', 'Ofertas&Mas');
        $mail->addAddress($email, $nombre_completo);
        $mail->isHTML(true);
        $mail->Subject = 'Ofertas&Mas Compra realizada';
        $mail->Body    = 'Gracias por su compra en Ofertas & Mas. Adjunto encontrará su código QR.';
        $mail->AltBody = 'Gracias por su compra en Ofertas & Mas. Adjunto encontrará su código QR.';

        $mail->addAttachment($pdfFile);

        $mail->send();
        echo 'El mensaje ha sido enviado con éxito';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
    }

    unlink($qrCodeFile);
    unlink($pdfFile);

} else {
    echo 'Error al insertar';
}
?>

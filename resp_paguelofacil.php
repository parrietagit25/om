<?php
session_start();
if (!isset($_SESSION['user_id'])) { 
    header("Location: index.php");
    exit();
}

include('conf/conn.php');
require 'vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use setasign\Fpdi\Fpdi;  

$datos = [
    "id_product" => $_GET['PARM_1'], 
    "id_user" => $_GET['PARM_2'], 
    "cantidad" => $_GET['PARM_3'], 
    "monto" => $_GET['PARM_4'], 
    "monto_total" => $_GET['CMTN'], 
    "stat" => 1, 
    "Fecha" => $_GET['Fecha'], 
    "Hora" => $_GET['Hora'], 
    "Tipo" => $_GET['Tipo'], 
    "Oper" => $_GET['Oper'], 
    "Usuario" => $_GET['Usuario'],  
    "Email" => $_GET['Email'],   
    "Razon" => $_GET['Razon'],   
    "Estado" => $_GET['Estado']
];

if ($_GET['CMTN'] > 0 && $_GET['Estado'] == 'Denegada') {

    $codigo = bin2hex(random_bytes(10)); 
    $datos['codigo_qr'] = $codigo;
    
    $insert = insert_reg('ventas', $datos, $conn);

    if ($insert) {
        echo 'Insertado con éxito';
    
        $usuario = select_datos_id("users_om", $conn, " id = '".$_SESSION['user_id']."'");
        foreach ($usuario as $key => $value) {
            $nombre_completo = $value['nombre']. ' ' . $value['apellido'];
            $email = $value['email'];
        }
    
        $dir = 'qr/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true); 
        }

        $qrCode = QrCode::create($codigo)
            ->setSize(300)
            ->setMargin(10)
            ->setEncoding(new Encoding('UTF-8'));  
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode);
    
        $qrCodeFile = $dir . 'qr_' . $codigo . '.png'; 
        $qrCodeImage->saveToFile($qrCodeFile);
    
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $logoPath = 'img/logo/2.png';  
        $logoX = ($pdf->GetPageWidth() - 50) / 2; 
        $pdf->Image($logoPath, $logoX, 20, 50); 

        $pdf->Ln(60);  
        $pdf->Cell(0, 10, 'Aquí está su código QR:', 0, 1, 'C');

        $qrCodeX = ($pdf->GetPageWidth() - 100) / 2;  
        $pdf->Image($qrCodeFile, $qrCodeX, 70, 100, 100); 

        $pdfFile = 'codigo_qr.pdf';
        $pdf->Output('F', $pdfFile);

        $mail = new PHPMailer(true);
    
        try {
            $mail->isSMTP();
            $mail->Host       = 'paul.hostservercloud.com';  
            $mail->SMTPAuth   = true;
            $mail->Username   = 'pedro.arrieta@ofmptygroup.com';  
            $mail->Password   = 'Chicho1787$$$'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
            $mail->Port       = 587;                      
            /*
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = 'html';
            */
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
    
        // No eliminar los archivos QR y PDF
        // unlink($qrCodeFile); 
        // unlink($pdfFile);
        unlink($pdfFile);
        header("Location: mis_compras.php");
        exit();
    
    } else {
        echo 'Error al insertar';
    }
    
} else {
    echo 'No se cumplen las condiciones para el registro.';
}

?>

<?php
include('conf/conn.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Obtener el código QR del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['codigo_qr'])) {
    echo json_encode(['success' => false, 'message' => 'Código QR no proporcionado.']);
    exit();
}

$codigo_qr = $input['codigo_qr'];

// Preparar la consulta para validar el código QR en la base de datos
$query = $conn->prepare("SELECT 
                            v.id, 
                            v.id_product, 
                            v.id_user, 
                            v.cantidad, 
                            v.monto, 
                            v.monto_total, 
                            v.stat, 
                            v.fecha_log, 
                            v.codigo_promo, 
                            v.Fecha, 
                            v.Hora, 
                            v.Tipo, 
                            v.Oper, 
                            v.Usuario, 
                            v.Email, 
                            v.Estado, 
                            v.Razon, 
                            u.nombre, 
                            u.apellido, 
                            p.titulo 
                         FROM 
                         ventas v inner join users_om u on v.id_user = u.id
                                  inner join products_om p on p.id = v.id_product 
                         WHERE 
                         codigo_qr = ?");
if (!$query) {
    // Mostrar error si la consulta no se preparó correctamente
    echo json_encode(['success' => false, 'message' => 'Error en la consulta SQL: ' . $conn->error]);
    exit();
}

$query->bind_param('s', $codigo_qr);
$query->execute();

// Usar bind_result para obtener los datos
$query->bind_result($id, $id_product, $id_user, $cantidad, $monto, $monto_total, $stat, $fecha_log, $codigo_promo, $Fecha, $Hora, $Tipo, $Oper, $Usuario, $Email, $Estado, $Razon, $nombre, $apellido, $titulo);

if ($query->fetch()) {
    // Si el código QR existe, devolver los datos de la venta
    echo json_encode([
        'success' => true,
        'id' => $id,
        'id_product' => $id_product,
        'id_user' => $id_user,
        'cantidad' => $cantidad,
        'monto' => $monto,
        'monto_total' => $monto_total,
        'stat' => $stat == 1 ? 'Sin canjear' : 'Canjeado',
        'fecha_log' => $fecha_log,
        'codigo_promo' => $codigo_promo,
        'Fecha' => $Fecha,
        'Hora' => $Hora,
        'Tipo' => $Tipo,
        'Oper' => $Oper,
        'Usuario' => $Usuario,
        'Email' => $Email,
        'Estado' => $Estado,
        'Razon' => $Razon, 
        'nombre' => $nombre,
        'apellido' => $apellido,
        'titulo' => $titulo
        
    ]);
} else {
    // Si no existe, devolver un mensaje de error
    echo json_encode(['success' => false, 'message' => 'Código QR no válido.']);
}

$query->close();
$conn->close();
?>

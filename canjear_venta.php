<?php
include('conf/conn.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Obtener el ID de la venta del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID de la venta no proporcionado.']);
    exit();
}

$id = $input['id'];

// Preparar la consulta para actualizar el estado de la venta
$query = $conn->prepare("UPDATE ventas SET stat = 2 WHERE id = ?");
if (!$query) {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta SQL: ' . $conn->error]);
    exit();
}

$query->bind_param('i', $id);
$query->execute();

if ($query->affected_rows > 0) {
    echo json_encode(['success' => true, 'message' => 'Venta canjeada correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudo actualizar la venta.']);
}

$query->close();
$conn->close();
?>

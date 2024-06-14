<?php
include 'db_connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if ($data === null) {
    echo json_encode(['message' => 'Error al decodificar JSON']);
    exit;
}

$user_id = $data->user_id;
$fecha = $data->date;
$entrada = $data->text;

$sql = "INSERT INTO entradas_diario (user_id, fecha, entrada) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE entrada=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $fecha, $entrada, $entrada);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Entrada guardada']);
} else {
    echo json_encode(['message' => 'Error: ' . $conn->error]);
}

$stmt->close();
$conn->close();
?>


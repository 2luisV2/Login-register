<?php
include '../db_connection.php'; // Ajusta la ruta si es necesario

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if ($data === null) {
    echo json_encode(['message' => 'Error al decodificar JSON']);
    exit;
}

$user_id = $data->user_id;
$fecha = $data->date;
$entrada = $data->text;

// Verifica que el user_id existe en la tabla usuarios
$check_user_sql = "SELECT id FROM usuarios WHERE id = ?";
$check_user_stmt = $conn->prepare($check_user_sql);
$check_user_stmt->bind_param("i", $user_id);
$check_user_stmt->execute();
$check_user_stmt->store_result();

if ($check_user_stmt->num_rows == 0) {
    echo json_encode(['message' => 'Error: Usuario no encontrado']);
    exit;
}

$check_user_stmt->close();

$sql = "INSERT INTO entradas_diario (user_id, fecha, entrada) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE entrada=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $fecha, $entrada, $entrada);

try {
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Entrada guardada']);
    } else {
        throw new Exception('Error: ' . $conn->error);
    }
} catch (Exception $e) {
    echo json_encode(['message' => $e->getMessage()]);
}

$stmt->close();
$conn->close();
?>

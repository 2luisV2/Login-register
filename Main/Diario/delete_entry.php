<?php
include 'db_connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);

    $user_id = $_DELETE['user_id'];
    $fecha = $_DELETE['date'];

    $sql = "DELETE FROM entradas_diario WHERE user_id=? AND fecha=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $fecha);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Entrada eliminada']);
    } else {
        echo json_encode(['message' => 'Error: ' . $conn->error]);
    }

    $stmt->close();
    $conn->close();
}
?>

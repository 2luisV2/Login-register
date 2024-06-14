<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'db_connection.php';

header('Content-Type: application/json');

$user_id = $_GET['user_id'];
$fecha = $_GET['date'];

$sql = "SELECT * FROM entradas_diario WHERE user_id=? AND fecha=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $fecha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
?>

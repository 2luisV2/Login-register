<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db_connection.php';

header('Content-Type: application/json');

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM entradas_diario WHERE user_id=? ORDER BY fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$entries = [];
while ($row = $result->fetch_assoc()) {
    $entries[] = $row;
}

echo json_encode($entries);

$stmt->close();
$conn->close();
?>

<?php
session_start();
include('config.php');

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM entradas_diario WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "Fecha: " . $row['fecha'] . "<br>";
    echo "Entrada: " . $row['entrada'] . "<br><br>";
}

$stmt->close();
$conn->close();
?>

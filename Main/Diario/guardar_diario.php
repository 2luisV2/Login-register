<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $fecha = $_POST['fecha'];
    $contenido = $_POST['contenido'];

    include '../../php/conexion_be.php';

    $stmt = $conexion->prepare("INSERT INTO diarios (user_id, fecha, contenido) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $user_id, $fecha, $contenido);

    if ($stmt->execute()) {
        header('Location: diario.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>

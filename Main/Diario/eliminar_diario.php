<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include '../../php/conexion_be.php';

    $stmt = $conexion->prepare("DELETE FROM diarios WHERE id = ? AND user_id = ?");
    $stmt->bind_param('ii', $id, $_SESSION['user_id']);

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

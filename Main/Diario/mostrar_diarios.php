<!-- mostrar_diarios.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
include '../../php/conexion_be.php'; // Ajusta la ruta si es necesario

$result = $conexion->query("SELECT * FROM diarios WHERE user_id = $user_id ORDER BY fecha DESC");

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['fecha'] . "</h3>";
    echo "<p>" . $row['contenido'] . "</p>";
    echo "<a href='eliminar_diario.php?id=" . $row['id'] . "'>Eliminar</a>";
    echo "</div>";
}

$conexion->close();
?>

<?php
session_start();
include('config.php'); // Archivo que contiene la conexión a la base de datos

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id']; // Asumiendo que tienes guardado el user_id en la sesión
    $fecha = date('Y-m-d'); // Fecha actual
    $entrada = $_POST['entrada'];

    $query = "INSERT INTO entradas_diario (user_id, fecha, entrada) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $fecha, $entrada);

    if ($stmt->execute()) {
        echo "Entrada guardada exitosamente.";
    } else {
        echo "Error al guardar la entrada.";
    }

    $stmt->close();
    $conn->close();
}
?>

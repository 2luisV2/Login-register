<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diario Personal</title>
<link rel="stylesheet" href="../NavBar/assets/sass/styles.css">


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        .note {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .note-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .note-header span {
            font-size: 12px;
            color: #888;
        }
        .note-header button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .note-header button:hover {
            background-color: #d32f2f;
        }
        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
    <?php include '../NavBar/index.php'; ?>
    </header>
    <div class="container">
        <h2 id="note-title">Nueva Nota</h2>
        <form method="POST" action="guardar_diario.php">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required><br>
            <label for="contenido">Contenido:</label>
            <textarea name="contenido" required></textarea><br>
            <button type="submit">Guardar Nota</button>
        </form>
        <h2>Notas Guardadas</h2>
        <div id="notes-container">
            <?php
            include '../../php/conexion_be.php';
            $user_id = $_SESSION['user_id'];
            $result = $conexion->query("SELECT * FROM diarios WHERE user_id = $user_id ORDER BY fecha DESC");

            while ($row = $result->fetch_assoc()) {
                echo "<div class='note'>";
                echo "<div class='note-header'>";
                echo "<span>{$row['fecha']}</span>";
                echo "<button onclick='deleteNote({$row['id']})'>Borrar</button>";
                echo "</div>";
                echo "<p>{$row['contenido']}</p>";
                echo "</div>";
            }
            $conexion->close();
            ?>
        </div>
    </div>

    <script>
        function deleteNote(id) {
            if (confirm('¿Seguro que deseas eliminar esta nota?')) {
                window.location.href = `eliminar_diario.php?id=${id}`;
            }
        }
    </script>
</body>
</html>

<?php
    
    session_start();

    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Por favor primero debe iniciar sesión");
            </script> 
        ';
        header("location: index.php");
        session_destroy();
        die();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="NavBar/assets/sass/styles.css">
</head>
<body>
<?php include 'NavBar/index.php'; ?>
    <main>
        <h1>Bienvenido a la página de inicio</h1>
        <p>Contenido de la página de inicio...</p>
        <a href="../php/cerrar_sesion.php">Cerrar sesión</a>
    </main>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <script src="NavBar/main.js"></script>
</body>
</html>
</html>
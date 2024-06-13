<?php
    session_start();

    if(isset($_SESSION['usuario'])){
        header("location: Main/Main/index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KALU EMOCIONES - INICIA SESIÓN O CREA UNA CUENTA</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>

        <main>

            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar a la página</p>
                        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aún no te nos unes?</h3>
                        <p>Regístrate ahora para ser parte de nosotros</p>
                        <button id="btn__registrarse">Regístrarse</button>
                    </div>
                </div>

                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="php/login_usuario_be.php" method="POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" placeholder="Correo Electronico" name = "correo">
                        <input type="contrasena" placeholder="Contraseña" name = "contrasena">
                        <button>Entrar</button>
                    </form>

                    <!--Register-->
                    <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                        <h2>Únete</h2>
                        <input type="text" placeholder="Nombre completo" name = "nombre_completo" >
                        <input type="text" placeholder="Correo Electronico" name = "correo">
                        <input type="text" placeholder="Usuario" name = "usuario" >
                        <input type="contrasena" placeholder="Contraseña" name = "contrasena" >
                        <button>Regístrarse</button>
                    </form>
                </div>
            </div>

        </main>

        <script src="assets/js/script.js"></script>
</body>
</html>
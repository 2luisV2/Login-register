<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="NavBar/assets/sass/styles.css">

    <style> 
        @import url('https://fonts.googleapis.com/css2?family=Mukta+Vaani:wght@200;300;400;500;600;700;800&display=swap');
    </style>

    <script type="text/javascript">
        function ajax(){
            var req = new XMLHttpRequest();

            req.onreadystatechange = function(){
                if (req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }

            req.open('GET', 'chat.php', true);
            req.send();
        }

        ajax();
        setInterval(function(){ajax();}, 1000);
    </script>

</head>
<body>
<?php include 'NavBar/index.php'; ?>
    <div id="contenedor">
        <div id="caja-chat">
            <div id="chat">  </div>
        </div>
        <form method="POST" action="index.php">
            <input type="text" name="nombre" placeholder= "Ingresa tu nombre">
            <textarea name="mensaje" placeholder="Ingresa tu mensaje"></textarea>
            <input type="submit" name="enviar" value="Enviar">
        </form>
        <?php
        if(isset($_POST['enviar'])){
            $nombre = $_POST['nombre'];
            $mensaje = $_POST['mensaje'];
            
            $consulta = "INSERT INTO chat (nombre, mensaje) VALUES (?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("ss", $nombre, $mensaje);
            $stmt->execute();

            if($stmt->affected_rows > 0) {
                echo "<embed loop='false' src='msg.mp3' hidden='true' autoplay='true'>";
            }
            header('Location: index.php');
            exit;
        }
        ?>
    </div>

</body>
</html>

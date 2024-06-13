<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$scores = $data['scores'];
$diagnosis = $conn->real_escape_string($data['diagnosis']);

$ansiedad = $conn->real_escape_string($scores['ansiedad']);
$depresion = $conn->real_escape_string($scores['depresion']);
$estres = $conn->real_escape_string($scores['estres']);
$insomnio = $conn->real_escape_string($scores['insomnio']);
$bajaAutoestima = $conn->real_escape_string($scores['bajaAutoestima']);

$sql = "INSERT INTO results (ansiedad, depresion, estres, insomnio, baja_autoestima, diagnosis) VALUES 
        ('$ansiedad', '$depresion', '$estres', '$insomnio', '$bajaAutoestima', '$diagnosis')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

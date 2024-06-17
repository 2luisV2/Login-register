<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Diario</title>
</head>
<body>
  <div class="container">
    <div class="form-container">
      <form id="diaryForm">
        <label for="date">Fecha:</label>
        <input type="text" id="date" name="date" readonly>
        <label for="entry">Entrada:</label>
        <textarea id="entry" name="entry" rows="10" required></textarea>
        <div class="button-container">
          <button type="button" id="saveButton">Guardar</button>
          <button type="button" id="loadButton">Cargar</button>
          <button type="button" id="deleteButton">Borrar</button>
        </div>
      </form>
    </div>
    <div class="entries-container">
      <label for="entries">Entradas guardadas:</label>
      <select id="entries" size="10"></select>
    </div>
  </div>
  <script src="diary.js"></script>
</body>
</html>

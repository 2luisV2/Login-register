<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Diario Digital</title>
</head>
<body>
  <div class="container">
    <h1>Diario Digital</h1>
    <form id="diary-form">
      <label for="date">Fecha:</label>
      <input type="text" id="date" name="date" readonly>
      
      <label for="title">Título:</label>
      <input type="text" id="title" name="title" required>
      
      <label for="content">Contenido:</label>
      <textarea id="content" name="content" rows="10" required></textarea>
      
      <div class="buttons">
        <button type="button" id="load-entry">Cargar</button>
        <button type="button" id="save-entry">Guardar</button>
        <button type="button" id="delete-entry">Borrar</button>
      </div>
    </form>
    
    <div class="entries">
      <h2>Entradas Guardadas</h2>
      <ul id="entries-list"></ul>
    </div>
  </div>
  
  <script src="script.js"></script>
</body>
</html>

<div class="form-wrapper">
  <h2>Crear nueva tarea</h2>
  <form method="POST" action="/gestion-tareas-diana/public/index.php?action=saveTask">
    <label for="">Titulo</label>
    <input type="text" name="title" placeholder="Título" required>
    <label for="">Descripción</label>
    <textarea name="description" placeholder="Descripción" required></textarea>
    <label for="">Fecha de vencimiento</label>
    <input type="date" name="due_date" required>

    <label for="">Prioridad</label>

    <select name="priority" required>
      <option value="Alta">Alta</option>
      <option value="Media">Media</option>
      <option value="Baja">Baja</option>
    </select>


    <button type="submit">Crear tarea</button>
  </form>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
    <link rel="stylesheet" href="/gestion-tareas-diana/public/css/createTask.css">
</head>
<body>
    
</body>
</html>

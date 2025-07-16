<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pendingTask.css">
    <title>Pendientes</title>
</head>
<body>
 <div class="form-wrapper">
  <h2>Tareas Pendientes</h2>

  <?php if (empty($tasks)): ?>
    <p style="margin-top: 20px;">No hay tareas pendientes.</p>
  <?php else: ?>
    <table class="task-table">
      <thead>
        <tr>
          <th>Título</th>
          <th>Descripción</th>
          <th>Fecha límite</th>
          <th>Prioridad</th>
          <th>Comentario</th>
          <th>Archivo</th>
          <th>Completar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task): ?>
          <tr>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= htmlspecialchars($task['description']) ?></td>
            <td><?= htmlspecialchars($task['due_date']) ?></td>
            <td><?= htmlspecialchars($task['priority']) ?></td>
            <td><?= htmlspecialchars($task['comentario'] ?? '-') ?></td>
            <td>
              <?php if (!empty($task['archivo'])): ?>
                <a href="uploads/<?= htmlspecialchars($task['archivo']) ?>" target="_blank">Ver archivo</a>
              <?php else: ?>
                -
              <?php endif; ?>
            </td>
            <td>
     <button
  class="complete-btn"
  data-id="<?= $task['id'] ?>"
  data-title="<?= htmlspecialchars($task['title']) ?>"
  data-description="<?= htmlspecialchars($task['description']) ?>"
>
  Completar
</button>


            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<!-- modl para gestionar tareas pendientes -->
<div id="completeModal" class="modal" style="display: none;">
  <div class="modal-content">
    <span class="close-complete">&times;</span>
    <h3>Completar Tarea</h3>
    <form id="complete-form" enctype="multipart/form-data">
      <input type="hidden" name="id" id="complete-id">

      <label for="complete-title">Título</label>
      <input type="text" id="complete-title" disabled>

      <label for="complete-description">Descripción</label>
      <textarea id="complete-description" disabled></textarea>

      <label for="comentario">Comentario</label>
      <textarea name="comentario" required></textarea>

      <label for="archivo">Adjuntar archivo</label>
      <input type="file" name="archivo" accept=".pdf,.doc,.docx,.png,.jpg">

      <button type="submit">Guardar</button>
    </form>
  </div>
</div>

 <script src="js/pendingTasks.js"></script>
</body>
</html>
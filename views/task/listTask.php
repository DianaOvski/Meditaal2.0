<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
    <link rel="stylesheet" href="/gestion-tareas-diana/public/css/listTask.css">

</head>

<body>
    <div class="form-wrapper">
        <h2> Mis Tareas</h2>

        <?php if (empty($tasks)): ?>
            <p style="margin-top: 8px;">No tienes tareas registradas.</p>
        <?php else: ?>

            <div class="filters">
                <label>
                    Fecha límite:
                    <input type="date" id="filter-date">
                </label>

                <label>
                    Prioridad:
                    <select id="filter-priority">
                        <option value="">Todas</option>
                        <option value="Alta">Alta</option>
                        <option value="Media">Media</option>
                        <option value="Baja">Baja</option>
                    </select>
                </label>

                <label>
                    Estado:
                    <select id="filter-status">
                        <option value="">Todos</option>
                        <option value="Completada">Completada</option>
                        <option value="Pendiente">Pendiente</option>
                    </select>
                </label>
            </div>

            <table class="task-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Fecha límite</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= htmlspecialchars($task['title']) ?></td>
                            <td><?= htmlspecialchars($task['description']) ?></td>
                            <td><?= htmlspecialchars($task['due_date']) ?></td>
                            <td><?= htmlspecialchars($task['priority']) ?></td>
                            <td><?= $task['completed'] ? 'Completada' : 'Pendiente' ?></td>
                            <td>
                                <?php if ($task['completed']): ?>
                                    <button class="view-btn"
                                        data-title="<?= htmlspecialchars($task['title']) ?>"
                                        data-description="<?= htmlspecialchars($task['description']) ?>"
                                        data-comentario="<?= htmlspecialchars($task['comentario']) ?>"
                                        data-archivo="<?= htmlspecialchars($task['archivo']) ?>">
                                        Ver
                                    </button>
                                <?php else: ?>
                                    <button class="edit-btn"
                                        data-id="<?= $task['id'] ?>"
                                        data-title="<?= htmlspecialchars($task['title']) ?>"
                                        data-description="<?= htmlspecialchars($task['description']) ?>"
                                        data-due_date="<?= $task['due_date'] ?>"
                                        data-priority="<?= $task['priority'] ?>"
                                        data-completed="<?= $task['completed'] ?>">
                                        Editar
                                    </button>
                                    <button class="delete-btn" data-id="<?= $task['id'] ?>">Eliminar</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Modal para editar -->
    <div id="editModal" class="modal hidden">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Editar Tarea</h3>
            <form method="POST" action="/gestion-tareas-diana/public/index.php?action=updateTask">
                <input type="hidden" name="id" id="edit-id">
                <label for="">Título</label>
                <input type="text" name="title" id="edit-title" required>
                <label for="">Descripción</label>
                <textarea name="description" id="edit-description" required></textarea>
                <label for="">Fecha de vencimiento</label>
                <input type="date" name="due_date" id="edit-due_date" required>
                <label for="">Prioridad</label>
                <select name="priority" id="edit-priority" required>
                    <option value="Alta">Alta</option>
                    <option value="Media">Media</option>
                    <option value="Baja">Baja</option>
                </select>
                <button type="submit">Guardar cambios</button>
            </form>
        </div>
    </div>

    <!-- Modal para confirmar eliminación -->
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content delete">
            <span class="close-delete">&times;</span>
            <h3>¿Estás segura de eliminar esta tarea?</h3>
            <form method="POST" action="/gestion-tareas-diana/public/index.php?action=deleteTask">
                <input type="hidden" name="id" id="delete-id">
                <div class="modal-buttons">
                    <button type="submit" class="btn-confirm">Sí, eliminar</button>
                    <button type="button" class="btn-cancel">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para ver detalles de la tarea finalizada -->
    <div id="viewModal" class="modal view-modal" style="display: none;">
  <div class="modal-content view-modal-content">
    <span class="close-view">&times;</span>
    <h3>Detalles de la Tarea</h3>

    <label for="view-title">Título</label>
    <input type="text" id="view-title" class="view-input" disabled>

    <label for="view-description">Descripción</label>
    <textarea id="view-description" class="view-textarea" disabled></textarea>

    <label for="view-comentario">Comentario</label>
    <textarea id="view-comentario" class="view-textarea" disabled></textarea>

    <label for="view-archivo">Archivo</label>
    <p id="view-archivo" class="view-file">-</p>
  </div>
</div>



    <script src="/gestion-tareas-diana/public/js/filter.js"></script>
    <script src="/gestion-tareas-diana/public/js/modal.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="css/auth.css">
    <script src="js/transition-load.js"></script>
    <link rel="stylesheet" href="../css/createTask.css">
</head>

<body>
    <div class="container" id="mainContainer">
        <!-- formulario -->
            <h2>Crear Usuario</h2>
    <div class="form-wrapper">

  <form method="POST" action="index.php?action=storeRegister">
    <label for="">Titulo</label>x
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
<!-- </div>
             <form method="POST" action="index.php?action=storeRegister">
                <input type="text" name="username" required placeholder="Nombre de usuario">
                <input type="email" name="email" required placeholder="Correo">
                <input type="password" name="password" required placeholder="Contraseña">
                <button type="submit">Registrarse</button>
            </form>
            <a href="index.php?action=login">Ya tengo una cuenta</a>
    </div>  -->

    <!-- cargando -->
    <div class="loader-overlay" id="loader" style="display: none;">
        <div class="spinner"></div>
        <p>Cargando...</p>
    </div>
</body>

</html>
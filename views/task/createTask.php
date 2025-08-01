<div class="form-wrapper">
  <h2>Crear un nuevo Usuario</h2>
  <form method="POST" id="usuarioForm">
    <input type="hidden" id="usu_id" name="usu_id">
    <label for="name">Nombres</label>
    <input type="text" id="name" name="name" placeholder="Nombres" required>
    <label for="">Apellidos</label>
    <input type="text" id="username" name="username" placeholder="Apellidos" required>
    <label for="">Correo electronico</label>
    <input type="email" id="email" name="email" placeholder="Prueba@prueba.com" required>
    <label for="">Contraseña</label>
    <input type="password" id="password" name="password" placeholder="Contraseña" required>
    <label for="">Tipo de Documento</label>
    <select id="documentType" name="documentType" required>
      <option value=""></option>
      <option value="Cedula Ciudadania">Cedula de Ciudadania</option>
      <option value="Tarjeta Indentidad">Tarjeta de Identidad</option>
      <option value="Pasaporte">Pasaporte</option>
      <option value="Cedula Extranjeria">Cedula de extranjería</option>
      <option value="PP">P.P</option>
      <option value="NIT">NIT</option>
    </select>
    <label for="">Número de Documento</label>
    <input type="number" id="documentNumber" name="documentNumber" placeholder="Número de Documento no puede empezar con 0" required>
    <label for="">Rol</label>
    <select id="Rol" name="Rol" required>
      <option value=""></option>
      <option value="Administrador">Administrador</option>
      <option value="Doctor">Doctor</option>
      <option value="Auxiliar">Auxiliar</option>
    </select>

    <button type="reset">Cancelar</button>
    <!-- <button type="submit">Crear Usuario</button> -->
     <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Crear Usuario</button>
  </form>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
    <link rel="stylesheet" href="css/createTask.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/CreaterUser.js"></script>
</head>
<body>
    
</body>
</html>


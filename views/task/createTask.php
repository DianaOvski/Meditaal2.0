<div class="form-wrapper">
  <h2>Crear un nuevo Usuario</h2>
  <form method="POST" action="index.php?action=saveTask">
    <label for="">Nombres</label>
    <input type="text" name="Nombres" placeholder="Nombres" required>
    <label for="">Apellidos</label>
    <input type="text" name="Apellidos" placeholder="Apellidos" required>
    <label for="">Correo electronico</label>
    <input type="email" name="email" placeholder="Prueba@prueba.com" required>
    <label for="">Contraseña</label>
    <input type="password" name="password" placeholder="Contraseña" required>
    <label for="">Tipo de Documento</label>
    <select name="documentType" required>
      <option value=""></option>
      <option value="Cedula_Ciudadania">Cedula de Ciudadania</option>
      <option value="Tarjeta_Indentidad">Tarjeta de Identidad</option>
      <option value="Pasaporte">Pasaporte</option>
      <option value="CedulaEx">Cedula de extranjería</option>
      <option value="PP">P.P</option>
      <option value="NIT">NIT</option>
    </select>
    <label for="">Número de Documento</label>
    <input type="number" name="documentNumber" placeholder="Número de Documento" required>
    <label for="">Rol</label>
    <select name="Rol" required>
      <option value=""></option>
      <option value="Administrador">Administrador</option>
      <option value="Doctor">Doctor</option>
      <option value="Auxiliar">Auxiliar</option>
    </select>

    <button type="reset">Cancelar</button>
    <button type="submit">Crear Usuario</button>
  </form>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
    <link rel="stylesheet" href="css/createTask.css">
</head>
<body>
    
</body>
</html>

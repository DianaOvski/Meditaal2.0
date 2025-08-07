<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear paciente</title>
    <link rel="stylesheet" href="css/listTask.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/CreatePatient.js"></script>

</head>

<body>
    <main class="main">
  <section class="form-wrapper">
    <h2 class="form-title">Crear nuevo paciente</h2>
    <form class="task-form-grid" method="POST" id="pacienteForm">
  <div class="form-group">
    <label for="nombres">Nombres</label>
    <input type="text" id="nombres" name="nombres" placeholder="Nombres" required>
  </div>

  <div class="form-group">
    <label for="apellidos">Apellidos</label>
    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required>
  </div>

  <div class="form-group">
    <label for="fecha_nacimiento">Fecha de nacimiento</label>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
  </div>

  <div class="form-group">
    <label for="edad">Edad</label>
    <input type="number" id="edad" name="edad" placeholder="Edad" required>
  </div>

  <div class="form-group">
    <label for="genero">Género</label>
    <select id="genero" name="genero" required>
      <option value=""> </option>
      <option value="Femenino">Femenino</option>
      <option value="Masculino">Masculino</option>
    </select>
  </div>

  <div class="form-group">
    <label for="documento_tipo">Tipo de documento</label>
    <select id="documento_tipo" name="documento_tipo" required>
      <option value=""> </option>
      <option value="Cedula Ciudadania">Cédula de ciudadanía</option>
      <option value="Tarjeta Identidad">Tarjeta de Identidad</option>
      <option value="Cedula Extranjeria">Cédula de extranjería</option>
      <option value="Registro Civil">Registro civil</option>
      <option value="Pasaporte">Pasaporte</option>
      <option value="PEP">Permiso Especial de Permanencia</option>
      <option value="NIT">NIT</option>
      <option value="PPT">Permiso por Protección Temporal</option>
    </select>
  </div>

  <div class="form-group">
    <label for="documento_numero">Número de documento</label>
    <input type="number" id="documento_numero" name="documento_numero" placeholder="Número de Documento no puede empezar con 0"required>
  </div>

  <div class="form-group">
    <label for="rh">RH</label>
    <select id="rh" name="rh" required>
      <option value=""> </option>
      <option value="O+">O+</option>
      <option value="O-">O-</option>
      <option value="A-">A-</option>
      <option value="A+">A+</option>
      <option value="B+">B+</option>
      <option value="B-">B-</option>
      <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
    </select>
  </div>

  <div class="form-group">
    <label for="hijos">Cantidad de hijos</label>
    <select id="hijos" name="hijos" required>
      <option value=""> </option>
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
    </select>
  </div>

  <div class="form-group">
    <label for="pais">País</label>
    <input type="text" id="pais" name="pais" placeholder="País" required>
  </div>

  <div class="form-group">
    <label for="ciudad">Ciudad</label>
    <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" required>
  </div>

  <div class="form-group">
    <label for="zona">Zona</label>
    <select id="zona" name="zona" required>
      <option value=""> </option>
      <option value="Urbano">Urbano</option>
      <option value="Rural">Rural</option>
      <option value="Invasion">Invasión</option>
    </select>
  </div>

  <div class="form-group col-span-2">
    <label for="direccion">Dirección</label>
    <input type="text" id="direccion" name="direccion" placeholder="Dirección" required>
  </div>

  <div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="number" id="telefono" name="telefono" placeholder="Teléfono" required>
  </div>

  <div class="form-group">
    <label for="email">Correo electrónico</label>
    <input type="email" id="email" name="email" placeholder="Correo electrónico" required>
  </div>

  <div class="form-group">
    <label for="ocupacion">Ocupación</label>
    <input type="text" id="ocupacion" name="ocupacion" placeholder="Ocupación" required>
  </div>

  <div class="form-group">
    <label for="religion">Religión</label>
    <input type="text" id="religion" name="religion" placeholder="Religión" required>
  </div>

  <div class="form-group col-span-2">
    <label for="enfermedad">¿Padece alguna enfermedad?</label>
    <textarea id="enfermedad" name="enfermedad" placeholder="Describa si aplica..." required></textarea>
  </div>

  <div class="form-group col-span-2">
    <label for="medicamento">¿Toma algún medicamento?</label>
    <textarea id="medicamento" name="medicamento" placeholder="Describa si aplica..." required></textarea>
  </div>
  <br>

  <div class="form-group full-width">
    <button type="reset">Cancelar</button>
    <button type="submit" name="action" id="create_patient" value="add" class="btn btn-rounded btn-primary">Crear Paciente</button>
  </div>
</form>
  </section>
</main>
</div>
</body>
</html>
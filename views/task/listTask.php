<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
    <link rel="stylesheet" href="css/listTask.css">

</head>

<body>
    <main class="main">
  <section class="form-wrapper">
    <h2 class="form-title">Crear nuevo paciente</h2>
    <form class="task-form-grid">
  <div class="form-group">
    <label for="titulo">Nombres</label>
    <input type="text" id="titulo" placeholder="Nombres">
  </div>

  <div class="form-group">
    <label for="descripcion">Apellidos</label>
    <input type="text" id="descripcion" placeholder="Apellidos">
  </div>

  <div class="form-group">
    <label for="fecha">Fecha de nacimiento</label>
    <input type="date" id="fecha">
  </div>

  <div class="form-group">
    <label for="edad">Edad</label>
    <input type="number" id="edad" placeholder="Edad">
  </div>

  <div class="form-group">
    <label for="genero">Género</label>
    <select id="genero">
      <option value="Femenino">Femenino</option>
      <option value="Masculino">Masculino</option>
    </select>
  </div>

  <div class="form-group">
    <label for="tipoIdentificacion">Tipo de documento</label>
    <select id="tipoIdentificacion">
      <option value="c.c.">Cédula de ciudadanía</option>
      <option value="c.e.">Cédula de extranjería</option>
      <option value="t.i.">Tarjeta de identidad</option>
      <option value="r.c.">Registro civil</option>
      <option value="p">Pasaporte</option>
    </select>
  </div>

  <div class="form-group">
    <label for="documento">Número de documento</label>
    <input type="number" id="documento" placeholder="Número de documento">
  </div>

  <div class="form-group">
    <label for="rh">RH</label>
    <select id="rh">
      <option value="o+">O+</option>
      <option value="o-">O-</option>
      <option value="a+">A+</option>
      <option value="a-">A-</option>
      <option value="b+">B+</option>
      <option value="b-">B-</option>
      <option value="ab+">AB+</option>
      <option value="ab-">AB-</option>
    </select>
  </div>

  <div class="form-group">
    <label for="hijos">Cantidad de hijos</label>
    <select id="hijos">
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
    <input type="text" id="pais" placeholder="País">
  </div>

  <div class="form-group">
    <label for="ciudad">Ciudad</label>
    <input type="text" id="ciudad" placeholder="Ciudad">
  </div>

  <div class="form-group">
    <label for="zona">Zona</label>
    <select id="zona">
      <option value="urbano">Urbano</option>
      <option value="rural">Rural</option>
      <option value="invasion">Invasión</option>
    </select>
  </div>

  <div class="form-group col-span-2">
    <label for="direccion">Dirección</label>
    <input type="text" id="direccion" placeholder="Dirección">
  </div>

  <div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="number" id="telefono" placeholder="Teléfono">
  </div>

  <div class="form-group">
    <label for="email">Correo electrónico</label>
    <input type="email" id="email" placeholder="Correo electrónico">
  </div>

  <div class="form-group">
    <label for="ocupacion">Ocupación</label>
    <input type="text" id="ocupacion" placeholder="Ocupación">
  </div>

  <div class="form-group">
    <label for="religion">Religión</label>
    <input type="text" id="religion" placeholder="Religión">
  </div>

  <div class="form-group col-span-2">
    <label for="enfermedad">¿Padece alguna enfermedad?</label>
    <textarea id="enfermedad" placeholder="Describa si aplica..."></textarea>
  </div>

  <div class="form-group col-span-2">
    <label for="medicamento">¿Toma algún medicamento?</label>
    <textarea id="medicamento" placeholder="Describa si aplica..."></textarea>
  </div>
  <br>

  <div class="form-group full-width">
    <button type="submit" class="btn-submit">Crear Paciente</button>
  </div>
</form>

  </section>
</main>


    
</div>



</body>

</html>
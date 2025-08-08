<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/loadPatient.js"></script>
    <script src="../public/js/deletePatient.js"></script>
    <link rel="stylesheet" href="../public/css/pendingTask.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Pacientes</title>
</head>

 <section class="table-wrapper">
  <h2 class="table-title">Listado de Pacientes</h2>
  <table class="styled-table">
    <thead>
      <tr>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Tipo de Documento</th>
        <th>Número de Documento</th>
        <th>Teléfono</th>
        <th>Editar</th>
        <th data-label="Eliminar">
          <button class="btn-deactivate" title="Eliminar" onclick="eliminarPaciente(${patient.Documento})">
              <i class="ri-delete-bin-line"></i>
          </button>
        </th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</section>

</html>
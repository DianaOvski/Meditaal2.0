<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/pendingTask.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Pendientes</title>
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
      </tr>
    </thead>
    <tbody>
      <tr>
        <td data-label="Nombres">Laura</td>
        <td data-label="Apellidos">Gómez</td>
        <td data-label="Tipo de Documento">C.C.</td>
        <td data-label="Número de Documento">1032456789</td>
        <td data-label="Teléfono">3124567890</td>
        <td data-label="Editar">
          <button class="btn-edit" title="Editar"><i class="ri-pencil-line"></i></button>
        </td>
      </tr>
      <tr>
        <td data-label="Nombres">Carlos</td>
        <td data-label="Apellidos">Pérez</td>
        <td data-label="Tipo de Documento">T.I.</td>
        <td data-label="Número de Documento">950123456</td>
        <td data-label="Teléfono">3119876543</td>
        <td data-label="Editar">
          <button class="btn-edit" title="Editar"><i class="ri-pencil-line"></i></button>
        </td>
      </tr>
    </tbody>
  </table>
</section>

</html>
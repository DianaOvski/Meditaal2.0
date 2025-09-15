<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Dashboard - Plataforma AV' ?></title>
  <link rel="stylesheet" href="css/layout.css">

  <?php if (!empty($extraCss)) : ?>
    <link rel="stylesheet" href="css/<?= $extraCss ?>">
  <?php endif; ?>
</head>

<body>
  <div class="dashboard-container">

    <aside class="sidebar">
      <div class="logo">
        <img src="img/logo-plataformaav.png" alt="Logo">
        <h2 class="titleLayout" >Dra. Angela Parra</h2>
      </div>
      <nav class="menu">
        <div class="top-links">
          <a href="index.php?action=dashboard">Crear pacientes</a>
          <a href="index.php?action=pendingTasks">Mis Pacientes</a>
          <a href="index.php?action=create">Crear usuario</a>
          <a href="../views/users/createUser.php">Crear usuario Sin crear</a>
          <a href="../views/calendario/calendario.html">Agenda</a>
          <a href="index.php?action=notes">Notas</a>
          <a href="index.php?action=agendaDos">Agenda Dos</a>
        </div>
        <div class="bottom-link">
          <a href="index.php?action=logout">Cerrar sesión</a>
        </div>
      </nav>
    </aside>

    <div class="main-content">

      <div class="content">
        <?php
        if (isset($view) && file_exists($view)) {
          include $view;
        } else {
          echo "<p>Error: vista no encontrada.</p>";
        }
        ?>
      </div>
    </div>

  </div>
</body>

</html>

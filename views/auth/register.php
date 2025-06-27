<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="/gestion-tareas-diana/public/css/auth.css">
    <script src="/gestion-tareas-diana/public/js/transition-load.js"></script>
</head>

<body>
    <div class="container" id="mainContainer">
        <!-- imagen -->
        <div class="left-panel">
            <img src="/gestion-tareas-diana/public/img/logo-plataformaav.png" alt="logo-plataformaav">
            <p class="tittle">Plataforma Av</p>
            <p class="text"> Event Production Company</p>
        </div>

        <!-- formulario -->
        <div class="right-panel">
            <h2>Registrate</h2>
            <form method="POST" action="index.php?action=storeRegister">
                <input type="text" name="username" required placeholder="Nombre de usuario">
                <input type="email" name="email" required placeholder="Correo">
                <input type="password" name="password" required placeholder="Contraseña">
                <button type="submit">Registrarse</button>
            </form>
            <a href="index.php?action=login">Ya tengo una cuenta</a>
        </div>
    </div>

    <!-- cargando -->
    <div class="loader-overlay" id="loader" style="display: none;">
        <div class="spinner"></div>
        <p>Cargando...</p>
    </div>
</body>

</html>
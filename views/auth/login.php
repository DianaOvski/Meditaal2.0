<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="css/auth.css">
    <script src="js/transition-load.js"></script>
</head>

<body>

    <div class="container" id="mainContainer">
        <!-- imagen -->
        <div class="left-panel">
            <img src="img/logo Angela.png" alt="logo-plataformaav">
            <p class="text"> Consultorio</p>
        </div>

        <!-- formulario -->
        <div class="right-panel">
            <h2>Iniciar sesión</h2>
            <form method="POST" action="index.php?action=storeLogin">
                <input type="email" name="email" placeholder="Correo" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Entrar</button>
            </form>
            <a href="index.php?action=register">¿No tienes cuenta? Regístrate</a>
        </div>
    </div>

    <!-- cargando -->
    <div class="loader-overlay" id="loader" style="display: none;">
        <div class="spinner"></div>
        <p>Cargando...</p>
    </div>

</body>

</html>
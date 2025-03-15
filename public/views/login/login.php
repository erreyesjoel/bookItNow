<?php
include '../seccions/header/header.php'; // Asegúrate de que la ruta sea correcta
include $_SERVER['DOCUMENT_ROOT'] . '/../callback.php'; // Incluir el archivo de configuración de Google
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="procesar_login.php" method="POST">
        <div class="container-login">
            <h1>Iniciar sesión</h1>

            <!-- Campo de nombre (usuario) -->
            <div class="input-group">
                <input class="nombre" type="text" id="nombre" name="username" placeholder="Usuario" required>
            </div>

            <!-- Campo de contraseña -->
            <div class="input-group">
                <input class="password" type="password" id="password" name="password" placeholder="Contraseña" required>
                <span id="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="button-submit">Iniciar sesión</button>

            <!-- Enlace para iniciar sesión con Google -->
            <?php
            // URL de autenticación de Google
            $authUrl = $client->createAuthUrl();
            ?>
            <div class="google-login">
                <a href="<?php echo $authUrl; ?>" class="button-google">Continuar con Google</a>
            </div>

            <!-- Enlaces -->
            <div class="links">
                <a href="/recuperar-contraseña.php" class="forgot-password">¿Olvidaste tu contraseña?</a>
                <p>No tienes cuenta? <a href="../registro/registro.php" class="register-link">Regístrate aquí</a></p>
            </div>
        </div>
    </form>

    <!-- Enlace al archivo JavaScript -->
    <script src="login.js"></script>
</body>
</html>

<?php
include '../seccions/footer/footer.php'; // Asegúrate de que la ruta sea correcta
?>

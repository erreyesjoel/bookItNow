<?php
include '../seccions/header/header.php'; 
include '../../callback.php';  // Retrocede dos directorios

// Incluir el archivo de configuración de Google
include $_SERVER['DOCUMENT_ROOT'] . '/../callback.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="registro.css"> 
</head>
<body>
    <form action="procesar_registro.php" method="POST">
        <div class="container-login">
            <h1>Registrarse</h1>

            <!-- Campo de nombre -->
            <div class="input-group">
                <input class="nombre" type="text" id="nombre" name="nombre" placeholder="Nombre completo" required>
            </div>

            <!-- Campo de correo -->
            <div class="input-group">
                <input class="correo" type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
            </div>

            <!-- Campo de contraseña -->
            <div class="input-group">
                <input class="password" type="password" id="password" name="password" placeholder="Contraseña" required>
                <span id="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <!-- Confirmar contraseña -->
            <div class="input-group">
                <input class="password" type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar contraseña" required>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="button-submit">Registrarse</button>

            <!-- Enlace para registro con Google -->
            <?php
            // URL de autenticación de Google
            $authUrl = $client->createAuthUrl();
            ?>
            <div class="google-register">
                <a href="<?php echo $authUrl; ?>" class="button-google">Continuar con Google</a>
            </div>

            <!-- Enlaces -->
            <div class="links">
                <p>¿Ya tienes cuenta? <a href="../login/login.php" class="register-link">Inicia sesión aquí</a></p>
            </div>
        </div>
    </form>

    <!-- Enlace al archivo JavaScript -->
    <script src="registro.js"></script>
</body>
</html>

<?php
include '../seccions/footer/footer.php'; 
?>

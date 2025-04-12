<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/User.php';
include '../seccions/header/header.php'; /* para incluir el header */
include '../../callback.php';  
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/connection/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/google-client.php';
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
if (isset($client)) {
    $authUrl = $client->createAuthUrl();
?>
    <div class="google-login">
        <a href="<?php echo $authUrl; ?>" class="button-google">Continuar con Google</a>
    </div>
<?php
} else {
    echo '<p>Error al configurar la autenticación de Google.</p>';
}
?>


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
// Verificar si el usuario ha iniciado sesión con Google
if (isset($userInfo)) {
    // Guardar los datos del usuario en la base de datos
    $userModel = new User($db); // Suponiendo que ya has creado la instancia de la clase User
    $googleUser = $userModel->findOrCreateGoogleUser($userInfo->id, $userInfo->name, $userInfo->email);
    
    // Redirigir al usuario a la página principal
    header("Location: /views/index/index.php"); 
    exit();
}

include '../seccions/footer/footer.php'; 
?>

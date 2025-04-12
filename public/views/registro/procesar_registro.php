<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../database/connection/connection.php';

// Obtener datos del formulario
$name = $_POST['nombre'];
$email = $_POST['correo'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Validar que las contraseñas coinciden
if ($password !== $confirmPassword) {
    die("Error: Las contraseñas no coinciden.");
}

try {
    // Conexión a la base de datos
    $db = new Database();
    $userModel = new User($db->getConnection());

    // Crear un nuevo usuario
    $user = $userModel->createTraditionalUser($name, $email, $password);

    // Iniciar sesión automáticamente
    session_start();
    $_SESSION['user'] = $user;

    header("Location: /views/index/index.php");
    exit;
    
} catch (Exception $e) {
    die("Error al registrar al usuario: " . $e->getMessage());
}
?>

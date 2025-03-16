<?php
require_once '../models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/connection/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../callback.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $db = new Database();
        $this->userModel = new User($db->getConnection());
    }

    public function handleGoogleLogin() {
        global $client; // Cliente de Google

        if (!isset($_GET['code'])) {
            die("Error: No se recibió el código de Google.");
        }

        // Intercambiar el código por un token de acceso
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);

        // Obtener información del usuario autenticado
        $oauth = new Google_Service_Oauth2($client);
        $googleUser = $oauth->userinfo->get();

        // Datos del usuario
        $googleId = $googleUser->id;
        $name = $googleUser->name;
        $email = $googleUser->email;

        // Verificar si el usuario ya existe o crearlo
        $user = $this->userModel->findOrCreateGoogleUser($googleId, $name, $email);

        // Guardar el usuario en sesión
        session_start();
        $_SESSION['user'] = $user;

        // Redirigir al dashboard
        header("Location: /views/dashboard.php");
        exit;
    }
}

// Ejecutar si se está autenticando con Google
$authController = new AuthController();
$authController->handleGoogleLogin();
?>

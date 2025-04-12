<?php
require_once __DIR__ . '/../models/User.php';  // Ruta relativa desde controllers/
require_once __DIR__ . '/../database/connection/connection.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/google-client.php'; // Configuración de Google

class AuthController {
    private $userModel;

    public function __construct() {
        $db = new Database();
        $this->userModel = new User($db->getConnection());
    }

    private function getGoogleUser() {
        global $client;
        if (!isset($client)) {
            throw new Exception("El cliente de Google no está configurado.");
        }

        // Intercambiar el código por un token de acceso
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            throw new Exception("Error al obtener el token de Google: " . htmlspecialchars($token['error']));
        }
        $client->setAccessToken($token);

        // Obtener información del usuario autenticado
        $oauth = new Google_Service_Oauth2($client);
        return $oauth->userinfo->get();
    }

    public function handleGoogleLogin() {
        try {
            $googleUser = $this->getGoogleUser();

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
        } catch (Exception $e) {
            die("Error en la autenticación con Google: " . htmlspecialchars($e->getMessage()));
        }
    }
}

// Ejecutar si se está autenticando con Google
$authController = new AuthController();
$authController->handleGoogleLogin();

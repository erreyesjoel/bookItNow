<?php
session_start();

// Verificar si el usuario está logeado
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    echo '<div class="welcome-message">';
    echo '¡Bienvenido, ' . htmlspecialchars($user['nombre']) . '!';
    echo '<a href="/logout.php" class="logout-btn">Cerrar sesión</a>';
    echo '</div>';
} else {
    // Mostrar el icono original de login
    echo '<a href="/views/login/login.php" class="login-icon">Iniciar sesión</a>';
}
?>

<?php
session_start();

// Incluir el modelo User.php y la conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/connection/connection.php';
?>
<header>
  <link rel="stylesheet" href="../css/header/header.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/tipografia/tipografia.css">
  <img class="logo" src="../images/logo.png">
  <nav class="menu-navegador">
    <a href="../../../views/reservas/reserva.php" class="btn-menu">Menus</a>
    <a href="/contactos.php" class="btn-menu">Contactos</a>
    <a href="/reservas.php" class="btn-menu">Reservas</a>
  </nav>
  <?php
  // Verificar si el usuario está logeado
  if (isset($_SESSION['user']['id'])) {
      $db = new Database();
      $userModel = new User($db->getConnection());

      // Obtener el usuario logeado desde la base de datos
      $user = $userModel->getUserById($_SESSION['user']['id']);

      // Mostrar mensaje de bienvenida
      echo '<div class="welcome-message">';
      echo '<span>¡Bienvenido, ' . htmlspecialchars($user['nombre']) . '!</span>';
      echo '<a href="/controllers/logout.php" class="logout-btn">Cerrar sesión</a>';
      echo '</div>';
      
  } else {
      // Mostrar el icono original de login
      echo '<img class="login-button" src="../images/login.png" alt="login-button" onclick="window.location.href=\'/views/login/login.php\'">';
  }
  ?>
</header>

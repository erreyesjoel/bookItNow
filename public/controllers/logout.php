<?php
session_start();
session_destroy(); // Elimina la sesión actual
header("Location: ../index/index.php"); // Redirige a la página de inicio
exit;
?>

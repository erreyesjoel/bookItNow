<?php
session_start();
session_destroy(); // Elimina la sesión actual
header("Location: /views/index/index.php");
exit;

?>

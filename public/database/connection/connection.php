<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servidor = "localhost";
$usuario = "administrador";
$password = "administrador"; /* password del usuario */
$bd = "itnow";

try {
    /* Establecer la conexión con la base de datos usando PDO, cogemos el servidor, nombre de la base de datos 
    usuario y contraseña del usuario que tiene permisos sobre la base de datos */
    $conecta = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $password);
    
    // Establecer el modo de error a la excepción para capturar errores
    $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mensaje de éxito si la conexión a la base de datos es exitosa, es decir, si funciona o no
    // echo "Conexión exitosa a la base de datos $bd";
} catch (PDOException $e) {
    // Capturar cualquier error de conexión y mostrar el mensaje de error
    echo "Error al conectar a la base de datos: " . $e->getMessage();
}
?>

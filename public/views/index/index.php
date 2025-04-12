<!-- index.php -->
<link rel="stylesheet" href="../css/index/index.css">
<?php
include __DIR__ . '/../controllers/session_status.php'; // Evaluar estado de la sesión
require_once '../../database/connection/connection.php';
require_once '../../models/Restaurantes.php';

// Crear una instancia de la clase Restaurantes y obtener los datos
$restaurantesModel = new Restaurantes($conecta);
$restaurantes = $restaurantesModel->obtenerRestaurantes();

// Contenido inicial
$content = "<div class='mensaje-bienvenida'>
                <h1>¡Bienvenido a nuestra selección de restaurantes!</h1>
                <p>Descubre los mejores restaurantes de comida rápida y variada de toda España. Ofrecemos información sobre menús, contactos y reservas. ¡Haz tu reserva ahora y disfruta de la mejor comida!</p>
            </div>";

// Generar dinámicamente las tarjetas de restaurantes
$tarjetasRestaurante = "<div class='tarjetas-container'><div class='tarjetas-restaurante'>";
foreach ($restaurantes as $restaurante) {
    $tarjetasRestaurante .= "
        <div class='tarjeta'>
            <div class='tarjeta-imagen'>
                <img src='/views/images/{$restaurante['foto']}' alt='Foto de {$restaurante['nombre_restaurante']}' class='tarjeta-foto'>
            </div>
            <div class='tarjeta-contenido'>
                <h2>{$restaurante['nombre_restaurante']}</h2>
                <div class='tarjeta-info'>
                    <p><i class='ubicacion-icon'>📍</i> {$restaurante['direccion']}</p>
                    <p><i class='telefono-icon'>📞</i> {$restaurante['telefono']}</p>
                </div>
                <button class='boton-reserva'>Reservar ahora</button>
            </div>
        </div>";
}
$tarjetasRestaurante .= "</div></div>";

// Combinar el contenido principal con las tarjetas
$content .= $tarjetasRestaurante;

include '../layouts/layout.php';
?>
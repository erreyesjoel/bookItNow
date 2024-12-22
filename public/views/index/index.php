<!-- index.php -->
<link rel="stylesheet" href="../css/index/index.css">
<?php
require_once '../../database/connection/connection.php'; // Incluye la conexión a la base de datos, hay que poner las rutas bien, que si no falla jaja
require_once '../../models/Restaurantes.php'; // Incluye el modelo Restaurantes

// Crear una instancia de la clase Restaurantes y obtener los datos
$restaurantesModel = new Restaurantes($conecta);
$restaurantes = $restaurantesModel->obtenerRestaurantes();

// Contenido inicial
$content = "<div class='mensaje-bienvenida'>
                <p>¡Bienvenido! Descubre los mejores restaurantes de comida rápida y variada de toda España. Ofrecemos información sobre menús, contactos y reservas. ¡Haz tu reserva ahora y disfruta de la mejor comida!</p>
            </div>";



// Generar dinámicamente las tarjetas de restaurantes
$tarjetasRestaurante = "<div class='tarjetas-restaurante'>";
foreach ($restaurantes as $restaurante) {
    $tarjetasRestaurante .= "
        <div class='tarjeta'>
            <img src='/views/images/{$restaurante['foto']}' alt='Foto de {$restaurante['nombre_restaurante']}' class='tarjeta-foto'>
            <h2>{$restaurante['nombre_restaurante']}</h2>
            <p>Dirección: {$restaurante['direccion']}</p>
            <p>Teléfono: {$restaurante['telefono']}</p>
        </div>";
}
$tarjetasRestaurante .= "</div>";

// Combinar el contenido principal con las tarjetas
$content .= $tarjetasRestaurante;

include '../layouts/layout.php';
?>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/User.php';
include '../seccions/header/header.php'; /* para incluir el header */
include '../../callback.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/database/connection/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/google-client.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecciona un Restaurante</title>
    <link rel="stylesheet" href="reserva.css">
    <link rel="stylesheet" href="modal_reserva.css">

</head>
<body>
    <h1>Selecciona un Restaurante</h1>

    <!-- Tabla de restaurantes -->
    <table class="tabla-restaurantes">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ejemplo de restaurante -->
            <tr>
                <td><img src="../images/la_fonda.jpg" alt="La Fonda" class="imagen-restaurante"></td>
                <td>La Fonda</td>
                <td>La mejor comida tradicional en un ambiente acogedor.</td>
                <td><button class="btn-reservar" onclick="mostrarReservaModal('La Fonda')">Reservar Mesa</button></td>
            </tr>
            <tr>
                <td><img src="../images/el_asador.jpg" alt="El Asador" class="imagen-restaurante"></td>
                <td>El Asador</td>
                <td>Disfruta de carnes a la parrilla en nuestro restaurante premium.</td>
                <td><button class="btn-reservar" onclick="mostrarReservaModal('El Asador')">Reservar Mesa</button></td>
            </tr>
            <tr>
                <td><img src="../images/pizzeria_bella.jpg" alt="Pizzería Bella" class="imagen-restaurante"></td>
                <td>Pizzería Bella</td>
                <td>Auténticas pizzas italianas hechas al horno.</td>
                <td><button class="btn-reservar" onclick="mostrarReservaModal('Pizzería Bella')">Reservar Mesa</button></td>
            </tr>
        </tbody>
    </table>

    <!-- Modal para realizar la reserva -->
    <div id="reservaModal" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarReservaModal()">&times;</span>
            <h2>Reserva tu Mesa en <span id="nombreRestaurante"></span></h2>
            <form action="procesar_reserva.php" method="POST">
                <input type="hidden" name="restaurante" id="restaurante">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" required>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>

                <label for="mesa">Número de Mesa:</label>
                <input type="number" id="mesa" name="mesa" required>

                <label for="comentarios">Comentarios:</label>
                <textarea id="comentarios" name="comentarios"></textarea>

                <div class="boton-container">
    <button class="btn-enviar" type="submit">Reservar</button>
</div>
            </form>
        </div>
    </div>

    <?php include '../seccions/footer/footer.php' ?>
</body>
<script src="modal_reserva.js"></script>
</html>

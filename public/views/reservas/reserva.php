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
    <title>Reservas</title>
</head>
<body>
<h1>Reservas...</h1>
<?php include '../seccions/footer/footer.php'?>
</body>
</html>
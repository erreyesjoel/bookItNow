<!-- layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header/header.css">
    <link rel="stylesheet" href="../css/footer/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/tipografia/tipografia.css">

</head>
<body>
    <?php
    include '../seccions/header/header.php';
    ?>

    <!-- Aquí pondremos el contenido de cada página -->
    <?php echo isset($content) ? $content : ''; ?>
    
    <?php
    include '../seccions/footer/footer.php';
    ?>
</body>
</html>

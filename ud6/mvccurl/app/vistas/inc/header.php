    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="id=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/estilos.css">
    <title><?php echo NOMBRESITIO; ?> </title>
    <nav>
        <a href="<?=RUTA_URL."/Mascotas/index";?>">Inicio | </a>        
        <a href="<?=RUTA_URL."/Mascotas/index";?>">mascotas </a>
        <a href="<?=RUTA_URL."/Paginas/mascotas_form";?>">Alta mascota</a>
        <?php if (!empty($_SESSION['usuario'])): ?>
            <span> | Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
            <a href="<?=RUTA_URL."/Auth/logout";?>"> | Logout</a>
        <?php else: ?>
            <a href="<?=RUTA_URL."/Auth/login";?>"> | Login</a>
        <?php endif; ?>
    </nav>
    <hr>
</head>
<body>
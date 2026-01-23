<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="id=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL?>/css/estilos.css">
    <title><?php echo NOMBRESITIO; ?> </title>
    <nav>
        <?php if(isset($_SESSION['correo'])):?>
        <a href="<?php echo RUTA_URL ?>/">Inicio</a>
        <a href="<?php echo RUTA_URL ?>/paginas/quienes_somos">Quienes somos</a>
        <a href="<?php echo RUTA_URL ?>/categorias/index">Categorias</a>
        <p>Usuario: <?php echo $_SESSION['correo']?></p>
        <a href="<?php echo RUTA_URL ?>/productos/mostrarCarrito">Carrito</a>
        <a href="<?php echo RUTA_URL ?>/usuarios/logout">Salir</a>
        <?php endif; ?>
    </nav>
</head>
<body>
    
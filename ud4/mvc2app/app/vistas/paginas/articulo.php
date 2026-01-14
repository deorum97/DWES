<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

<h1><?php echo $datos['titulo']; ?></h1>

<ul>
    <?php foreach($datos['articulos'] as $articulo): ?>
        <?php if($articulo): ?>
            <li><?php echo $articulo->titulo; ?></li>
        <?php else: ?>
            <li>Artículo no encontrado</li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>
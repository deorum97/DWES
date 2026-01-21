<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

    <h1><?php echo $datos['titulo']; ?></h1>

    <ul>
        <?php foreach($datos['categorias'] as $categoria): ?>
            <?php if($categoria): ?>
                <li>
                    <a href="<?php echo RUTA_URL."/productos/index/".$categoria->getId(); ?>"><?php echo $categoria->getNombre(); ?></a>
                </li>
            <?php else: ?>
                <li>Artículo no encontrado</li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?><?php

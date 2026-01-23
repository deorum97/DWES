<?php require_once RUTA_APP.'/vistas/inc/header.php';?>
    <h1><?php echo $datos['titulo']; ?></h1>

    <?php

        echo '<pre>';
        echo 'session_id: ' . session_id() . PHP_EOL;
        echo 'session_name: ' . session_name() . PHP_EOL;
        var_dump($_SESSION);
        echo '</pre>';

        ?>

    <?php if(empty($datos['carrito'])): ?>
        <p>Aun no has añadido nada al carrito</p>
        <a href="<?php echo RUTA_URL; ?>/categorias">Seguir comprando</a>
    <?php else: ?>
        <p>Pedido ID: <?php echo $_SESSION['pedido'] ?? 'No asignado'; ?></p>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Unidades</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($datos['carrito'] as $id => $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['producto']->getNombre()); ?></td>
                        <td><?php echo htmlspecialchars($item['producto']->getDescripcion()); ?></td>
                        <td><?php echo htmlspecialchars($item['unidades']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <div>
            <a href="<?php echo RUTA_URL; ?>/productos/eliminarCarrito" class="btn">Vaciar carrito</a>
            <a href="<?php echo RUTA_URL; ?>/categorias">Seguir comprando</a>
        </div>
    <?php endif; ?>
<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>

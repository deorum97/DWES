<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

    <h1><?php echo $datos['titulo']; ?></h1>

    <table>
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Peso (g)</th>
            <th>Stock</th>
            <th>Cantidad</th>
            <th>Comprar</th>
        </tr>
        </thead>
        <tbody>

        <?php if (!isset($datos['productos'])): ?>
            <tr>
                <td colspan="4">No hay productos</td>
            </tr>
        <?php else: ?>
            <?php foreach ($datos['productos'] as $p): ?>
                <?php if($p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p->getNombre()) ?></td>
                        <td><?= htmlspecialchars($p->getDescripcion()) ?></td>
                        <td><?= $p->getPrecio()?> €</td>
                        <td><?= $p->getPeso() ?></td>
                        <td><?= $p->getStock() ?></td>
                        <td>
                            <form method="post" action="<?php echo RUTA_URL."/productos/addCarrito"?>">
                                <input type="hidden" name="codProd" value="<?php echo htmlspecialchars($p->getCodProd()); ?>">
                                <input type="hidden" name="categoria" value="<?php echo htmlspecialchars($p->getCategoria() ?? ''); ?>">
                                <input type="number" name="cantidad" min="1" max="<?php echo $p->getStock(); ?>" value="1" required>
                        </td>
                        <td>
                            <button type="submit" <?php echo ($p->getStock() <= 0) ? 'disabled' : ''; ?>>Añadir al Carrito</button>
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
    </table>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?><?php

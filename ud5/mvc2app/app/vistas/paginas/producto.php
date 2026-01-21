<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

    <h1><?php echo $datos['titulo']; ?></h1>

    <?php if (isset($datos['producto'])): ?>
    <ul>
        <?php foreach($datos['producto'] as $p): ?>
            <?php if($p): ?>
                <li>
                    <strong>Nombre:</strong> <?php echo $p->Nombre; ?><br>
                    <strong>Descripción:</strong> <?php echo $p->Descripcion; ?><br>
                    <strong>Precio:</strong> <?php echo $p->Precio; ?> €
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <table>
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
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
                <tr>
                    <td><?= htmlspecialchars($p->Nombre) ?></td>
                    <td><?= htmlspecialchars($p->Descripcion) ?></td>
                    <td><?= $p->Peso ?></td>
                    <td><?= $p->Stock ?></td>
                    <td>
                        <form method="post" action="<?php echo RUTA_URL."/productos/addCarrito/".$p->CodProd;?>">
                            <input type="hidden" name="CodProd" value="<?php echo htmlspecialchars($p->CodProd); ?>">
                            <input type="hidden" name="cat" value="<?php echo htmlspecialchars($p->Categoria ?? ''); ?>">
                            <input type="number" name="cantidad" min="1" max="<?php echo $p->Stock; ?>" value="1" required>
                    </td>
                    <td>
                        <button type="submit" <?php echo ($p->Stock <= 0) ? 'disabled' : ''; ?>>Comprar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
    </table>

<?php require_once RUTA_APP.'/vistas/inc/footer.php';?><?php

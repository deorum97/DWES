<?php
require_once "../vendor/autoload.php";

use Jrm\Apco\Producto;

$codCat = $_GET["cat"];

try {
    $productos = Producto::getProductosPorCategoria($codCat);
} catch (\Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <h2>Productos</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Peso (g)</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>

        <?php if (empty($productos)): ?>
            <tr>
                <td colspan="4">No hay productos</td>
            </tr>
        <?php else: ?>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p["Nombre"]) ?></td>
                    <td><?= htmlspecialchars($p["Descripcion"]) ?></td>
                    <td><?= $p["Peso"] ?></td>
                    <td><?= $p["Stock"] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
    </table>
</body>
</html>
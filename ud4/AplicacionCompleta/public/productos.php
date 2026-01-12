<?php
session_start();
require_once "../vendor/autoload.php";

use Jrm\Apco\Producto;

if (!isset($_SESSION['correo'])) {
    header('Location: index.php');
    exit;
}

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
    <h2>Usuario</h2>
    <ul>
        <li>Usuario: <?php echo $_SESSION["correo"]?></li>
        <li><a href="carrito.php">Ver carrito</a></li>
        <li><a href="logout.php">Cerrar sesion</a></li>
    </ul>

    <h2>Productos</h2>

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

        <?php if (empty($productos)): ?>
            <tr>
                <td colspan="4">No hay productos</td>
            </tr>
        <?php else: ?>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p->getNombre()) ?></td>
                    <td><?= htmlspecialchars($p->getDescripcion()) ?></td>
                    <td><?= $p->getPeso() ?></td>
                    <td><?= $p->getStock() ?></td>
                    <td>
                    <form method="post" action="anadir_carrito.php">
                        <input type="hidden" name="CodProd" value="<?php echo htmlspecialchars($p->getCodProd()); ?>">
                        <input type="hidden" name="cat" value="<?php echo htmlspecialchars($p->getCategoria() ?? ''); ?>">
                        <input type="number" name="cantidad" min="1" max="<?php echo $p->getStock(); ?>" value="1" required>
                    </td>
                    <td>
                        <button type="submit" <?php echo ($p->getStock() <= 0) ? 'disabled' : ''; ?>>Comprar</button>
                        </form>
                    </td>
                    </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        </tbody>
    </table>
</body>
</html>
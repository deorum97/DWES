<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
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
    

    <table>
        <tr>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Unidades</th>
            <th>Acción</th>
        </tr>

        <?php foreach ($_SESSION['carrito'] as $codProd => $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td><?= htmlspecialchars($p['descripcion']) ?></td>
                <td><?= $p['unidades'] ?></td>
                <td>
                    <a href="eliminar_carrito.php?codProd=<?= $codProd ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        
    </table>

    <?php if (empty($_SESSION['carrito'])): ?>

        <hr>
        <p><strong>No hay productos en el carrito.</strong></p>
        <hr>
    <?php endif; ?>

    <a href="confirmar_carrito.php">Confirmar carrito</a><br><br>
        
    <a href="categorias.php">Volver a comprar</a>
</body>
</html>



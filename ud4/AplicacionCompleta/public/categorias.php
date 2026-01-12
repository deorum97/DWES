<?php
session_start();
require_once "../vendor/autoload.php";

use Jrm\Apco\Categoria;

if (!isset($_SESSION['correo'])) {
    header('Location: index.php');
    exit;
}

try {
    $categorias = Categoria::getAllCategorias();
} catch (\Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Categorias</title>
</head>
<body>
<main>
    <h2>Usuario</h2>
    <ul>
        <li>Usuario: <?php echo $_SESSION["correo"]?></li>
        <li><a href="carrito.php">Ver carrito</a></li>
        <li><a href="logout.php">Cerrar sesion</a></li>
    </ul>
    <h1>Categorias</h1>
    <section>
        <h2>Lista Categorias</h2>
        <ul>
            <?php foreach ($categorias as $categoria): ?>
                <li><a href="productos.php?cat=<?php echo $categoria->getId() ?>"><?php echo $categoria->getNombre() ?></a></li>
                
            <?php endforeach; ?>
        </ul>
    </section>
</main>
</body>
</html>
<?php
    session_start();
    require_once "../vendor/autoload.php";

    use Jrm\Apco\Producto;
    use Jrm\Apco\Pedido;
    use Jrm\Apco\LineaPedido;

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    $codProd = (int)($_POST['CodProd'] ?? '');
    $cantidad = (int)($_POST['cantidad'] ?? 0);
    $cat = (int)($_POST['cat'] ?? '');

    if(!isset($_SESSION["carrito"])){
        $_SESSION['carrito'] = [];
    }

    if (!isset($_SESSION['pedido'])) {
        $pedido = new Pedido($_SESSION['usuario']);
        $pedido->guardar();
        $_SESSION['pedido'] = $pedido->getCodPed();
    }

    if ($cantidad > 0) {
        if (isset($_SESSION['carrito'][$codProd])) {
            $_SESSION['carrito'][$codProd]['unidades'] += $cantidad;
        } else {
            $producto = Producto::getProductoPorId($codProd);
            $_SESSION['carrito'][$codProd] = [
                'nombre'      => $producto->getNombre(),
                'descripcion' => $producto->getDescripcion(),
                'unidades'    => $cantidad
            ];
        }

        $linea = new LineaPedido(
            $_SESSION['pedido'],
            $codProd,
            $cantidad
        );
        $linea->guardar();
    }

    header('Location: productos.php?cat=' . (int)($_POST['cat']) );
    exit;
?>
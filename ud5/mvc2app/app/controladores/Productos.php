<?php
namespace App\Controladores;

use App\Librerias\Controlador;
use App\Modelos\Pedido;
use App\Modelos\LineaPedido;

class Productos extends Controlador{
    public function __construct(){
        $this->productoModelo = $this->modelo('Producto');
        $this->lineaPedidoModelo = $this->modelo('LineaPedido');
    }

    public function index($id) {
        $productos = $this->productoModelo->getProductosPorCategoria($id);

        $datos = [
            'titulo' => "Productos",
            'productos' => $productos,
        ];

        $this->vista('paginas/producto', $datos);
    }

    public function producto($id){
        $producto = $this->productoModelo->getProductoPorId($id);
        $datos = [
            'titulo' => "Producto",
            'producto' => [$producto],
        ];

        $this->vista('paginas/producto', $datos);
    }

    public function addCarrito(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codProd = trim(htmlspecialchars($_POST['codProd']));
            $cantidad = trim(htmlspecialchars($_POST['cantidad']));
            $categoria = trim(htmlspecialchars($_POST['categoria']));

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            if (!isset($_SESSION['pedido'])) {
                $pedido = new Pedido($_SESSION['codRes']);
                $pedido->guardar();
                $_SESSION['pedido'] = $pedido->getCodPed();
            }

            if ($cantidad > 0) {
                if (isset($_SESSION['carrito'][$codProd])) {
                    $_SESSION['carrito'][$codProd]['unidades'] .= $cantidad;
                    $linea = new LineaPedido(
                        $_SESSION['pedido'],
                        $codProd,
                        $_SESSION['carrito'][$codProd]['unidades']
                    );
                    $linea->actualizar();
                } else {

                    $producto = $this->productoModelo->getProductoPorId($codProd);
                    $_SESSION['carrito'][$codProd] = [
                        'producto' => $producto,
                        'unidades' => $cantidad
                    ];

                    $linea = new LineaPedido(
                        $_SESSION['pedido'],
                        $codProd,
                        $cantidad
                    );
                    $linea->guardar();
                }
            }
            header('Location: ' . RUTA_URL . '/productos/' . $categoria);
            exit;
        }else{
            header('Location: ' . RUTA_URL . '/categorias');
            exit;
        }
    }

    public function eliminarCarrito(){
        unset($_SESSION['carrito']);
        header('Location: ' . RUTA_URL . '/carrito');
        exit;
    }
    public function mostrarCarrito(){

        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

        $datos = [
            'titulo' => 'Carrito de Compras',
            'carrito' => $carrito
        ];

        $this->vista('paginas/carrito', $datos);
    }
}

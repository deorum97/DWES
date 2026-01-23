<?php
namespace App\Controladores;

use App\Librerias\Controlador;

class Usuarios extends Controlador{
    public function __construct(){
        $this->usuariosModel = $this->modelo("Usuario");
    }

    public function index(){
        if (isset($_SESSION['correo'])) {
            header('Location: '.RUTA_URL.'/categorias');
            exit;
        }
        $datos = [
            'titulo' => 'Login',
        ];
        $this->vista("paginas/login", $datos);
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = trim($_POST['email']);
            $clave = trim($_POST['clave']);

            $usuario = $this->usuariosModel::login($correo, $clave);

            if($usuario){
                $_SESSION['correo'] = $usuario['Correo'];
                $_SESSION['codRes'] = $usuario['CodRes'];
                header('Location: ' . RUTA_URL . '/categorias');
                exit;
            }else{
                $datos = [
                    'titulo' => 'Login',
                    'error' => true,
                ];
                $this->vista("paginas/login", $datos);
            }
        } else {
            header('Location: ' . RUTA_URL . '/usuarios');
            exit;
        }
    }

    public function logout(){
        unset($_SESSION['correo']);
        unset($_SESSION['codRes']);
        unset($_SESSION['carrito']);
        unset($_SESSION['pedido']);
        session_destroy();
        header('Location: ' . RUTA_URL . '/usuarios');
        exit;
    }
}
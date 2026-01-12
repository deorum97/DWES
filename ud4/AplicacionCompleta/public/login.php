<?php
session_start();
require_once "../vendor/autoload.php";
use Jrm\Apco\Tools\Validadores;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['email'] ?? '';
    $clave = $_POST['clave'] ?? '';

    try {
        $user = Validadores::validarUsuario($correo, $clave);
        if ($user) {
            session_start();
            $_SESSION['correo'] = $user['Correo'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Correo o clave incorrectos.';
        }
    } catch (Exception $e) {
        $error = 'Error al autenticar: '.$e->getMessage();
    }
}else{
    header('Location: categorias.php');
    exit;
}
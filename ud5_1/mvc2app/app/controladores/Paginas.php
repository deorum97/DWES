<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Librerias\Controlador;

class Paginas extends Controlador
{
    public function __construct()
    {
        // nada
    }

    public function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si ya está logueado, vamos a categorías
        if (!empty($_SESSION['correo'])) {
            $this->redirect('/Categoria/categorias');
        }

        $error = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);

        $this->vista('paginas/login', [
            'titulo' => 'Login',
            'error' => $error,
        ]);
    }

    public function registro(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si ya está logueado, vamos a categorías
        if (!empty($_SESSION['correo'])) {
            $this->redirect('/Categoria/categorias');
        }

        $error = $_SESSION['registro_error'] ?? null;
        $exito = $_SESSION['registro_exito'] ?? null;
        unset($_SESSION['registro_error'], $_SESSION['registro_exito']);

        $this->vista('paginas/registro', [
            'titulo' => 'Registro',
            'error' => $error,
            'exito' => $exito,
        ]);
    }

    public function olvido_password(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $error = $_SESSION['olvido_error'] ?? null;
        $exito = $_SESSION['olvido_exito'] ?? null;
        unset($_SESSION['olvido_error'], $_SESSION['olvido_exito']);

        $this->vista('paginas/olvido_password', [
            'titulo' => 'Recuperar Contraseña',
            'error' => $error,
            'exito' => $exito,
        ]);
    }

    public function reset_password(string $id = ''): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($id === '') {
            $this->redirect('/Paginas/login');
        }

        $error = $_SESSION['reset_error'] ?? null;
        unset($_SESSION['reset_error']);

        $this->vista('paginas/reset_password', [
            'titulo' => 'Restablecer Contraseña',
            'id' => $id,
            'error' => $error,
        ]);
    }

    // Página de ejemplo (si quieres mantenerla)
    public function index(): void
    {
        $this->redirect('/Paginas/login');
    }
}

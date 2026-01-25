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

    // Página de ejemplo (si quieres mantenerla)
    public function index(): void
    {
        $this->redirect('/Paginas/login');
    }
}

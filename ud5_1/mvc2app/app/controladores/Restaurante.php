<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Librerias\Controlador;
use App\Tools\Mailer;

class Restaurante extends Controlador
{

    public function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Paginas/login');
        }

        $user = trim((string)($_POST['user'] ?? $_POST['email'] ?? ''));
        $pass = trim((string)($_POST['password'] ?? $_POST['clave'] ?? ''));

        if ($user === '' || $pass === '') {
            $_SESSION['login_error'] = 'Usuario/clave vacíos.';
            $this->redirect('/Paginas/login');
        }

        $modelo = $this->modelo('RestauranteModelo');
        $rest = $modelo->obtenerPorCredenciales($user, $pass);

        if (!$rest) {
            $_SESSION['login_error'] = 'Credenciales incorrectas.';
            $this->redirect('/Paginas/login');
        }

        $_SESSION['correo'] = $rest['Correo'] ?? $user;
        $_SESSION['codRes'] = $rest['CodRes'] ?? null;

        $this->redirect('/Categoria/categorias');
    }

    public function registrar(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Paginas/registro');
        }

        $correo = trim((string)($_POST['email'] ?? ''));
        $clave = trim((string)($_POST['password'] ?? ''));

        if ($correo === '' || $clave === '') {
            $_SESSION['registro_error'] = 'Por favor, rellena todos los campos.';
            $this->redirect('/Paginas/registro');
        }

        $modelo = $this->modelo('RestauranteModelo');

        // Comprobar si el correo ya existe
        if ($modelo->existeCorreo($correo)) {
            $_SESSION['registro_error'] = 'El correo ya está registrado.';
            $this->redirect('/Paginas/registro');
        }

        // Insertar (el modelo se encarga de hashear la contraseña)
        if ($modelo->insertar($correo, $clave)) {
            $_SESSION['registro_exito'] = 'Registro completado con éxito. Ya puedes iniciar sesión.';
            $this->redirect('/Paginas/login');
        } else {
            $_SESSION['registro_error'] = 'Hubo un error al procesar el registro.';
            $this->redirect('/Paginas/registro');
        }
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'], $params['secure'], $params['httponly']
            );
        }
        session_destroy();

        $this->redirect('/Paginas/login');
    }

    public function solicitar_reset(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Paginas/olvido_password');
        }

        $correo = trim((string)($_POST['email'] ?? ''));

        if ($correo === '') {
            $_SESSION['olvido_error'] = 'Por favor, introduce tu correo.';
            $this->redirect('/Paginas/olvido_password');
        }

        $modelo = $this->modelo('RestauranteModelo');
        $user = $modelo->obtenerPorCorreo($correo);

        if (!$user) {
            // Si no existe el correo se pasa el mensaje de error
            $_SESSION['olvido_error'] = 'No existe ningún usuario con ese correo.';
            $this->redirect('/Paginas/olvido_password');
        }

        $idUsuario = $user['CodRes'];
        $link = RUTA_URL . '/Paginas/reset_password/' . urlencode((string)$idUsuario);

        $html = "<h2>Restablecer Contraseña</h2>
                 <p>Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para continuar:</p>
                 <p><a href='$link'>$link</a></p>
                 <p>Si no solicitaste este cambio, puedes ignorar este correo.</p>";

        if (Mailer::enviarMensaje($correo, 'Restablecer Contraseña', $html)) {
            $_SESSION['olvido_exito'] = 'Se ha enviado un enlace a tu correo electrónico.';
        } else {
            $_SESSION['olvido_error'] = 'Error al enviar el correo. Inténtalo de nuevo más tarde.';
        }

        $this->redirect('/Paginas/olvido_password');
    }

    public function procesar_reset(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/Paginas/login');
        }

        $id = trim((string)($_POST['id'] ?? ''));
        $clave = trim((string)($_POST['password'] ?? ''));

        if ($id === '' || $clave === '') {
            $_SESSION['reset_error'] = 'Datos incompletos.';
            $this->redirect('/Paginas/reset_password/' . $id);
        }

        $modelo = $this->modelo('RestauranteModelo');

        // "verificará que el usuario existe"
        if (!$modelo->existeCodRes($id)) {
            $_SESSION['login_error'] = 'El usuario no existe.';
            $this->redirect('/Paginas/login');
        }

        if ($modelo->actualizarClave($id, $clave)) {
            $_SESSION['login_exito'] = 'Tu contraseña ha sido actualizada correctamente. Ya puedes iniciar sesión.';
            $this->redirect('/Paginas/login');
        } else {
            $_SESSION['reset_error'] = 'Hubo un error al actualizar la contraseña.';
            $this->redirect('/Paginas/reset_password/' . $id);
        }
    }
}

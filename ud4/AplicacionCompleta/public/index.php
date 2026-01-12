<?php
session_start();
require_once "../vendor/autoload.php";
use Jrm\Apco\Tools\Validadores;

if (isset($_SESSION['correo'])) {
    header('Location: categorias.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['email'] ?? '';
    $clave = $_POST['clave'] ?? '';

    try {
        $user = Validadores::validarUsuario($correo, $clave);
        if ($user) {
            session_start();
            $_SESSION['correo'] = $user['Correo'];
            $_SESSION['usuario'] = $user['CodRes'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Correo o clave incorrectos.';
        }
    } catch (Exception $e) {
        $error = 'Error al autenticar: '.$e->getMessage();
    }
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
    <a href="Categorias.php">Categorias</a>
    <h1>LOGIN</h1>

    <?php if (!empty($error)) { ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php } ?>

	<form method="post" action="">
        <label>Correo:</label>
        <input type="email" name="email" required autocomplete="email" />

        <label>Clave:</label>
        <input
          type="password"
          name="clave"
          required
          autocomplete="clave"
        />

        <input type="submit" value="Login" />
    </form>
</body>
</html>
<?php
session_start();
require '../vendor/autoload.php';

use Jrm\Apco\Tools\Conexion;
use Jrm\Apco\Tools\Mailer;

// 🔒 Comprobación básica
if (!isset($_SESSION['pedido']) || !isset($_SESSION['usuario'])) {
    header('Location: carrito.php');
    exit;
}

$codPed = $_SESSION['pedido'];
$codRes = $_SESSION['usuario'];

$pdo = Conexion::getConexion();

try {
    $sql = "UPDATE pedidos SET Enviado = 1 WHERE CodPed = :codPed";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':codPed' => $codPed]);

    $correo = $_SESSION["correo"];

    // 3️⃣ Construir el mensaje
    $htmlBody = "
        <h2>Pedido confirmado</h2>
        <p>Su pedido con código <strong>$codPed</strong> ha sido confirmado correctamente.</p>
        <p>Gracias por confiar en nuestro servicio.</p>
    ";

    // 4️⃣ Enviar email
    Mailer::enviarMensaje(
        $correo,
        'Confirmación de pedido',
        $htmlBody
    );

    // 5️⃣ Limpiar sesión
    unset($_SESSION['carrito']);
    unset($_SESSION['pedido']);

    echo "<h3>Pedido confirmado y email enviado correctamente.</h3>";

} catch (Exception $e) {
    echo "Error al confirmar el pedido";
}

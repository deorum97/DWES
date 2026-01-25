<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/config/config.php';

use App\Modelos\RestauranteModelo;

session_start();

$modelo = new RestauranteModelo();

$credenciales = [
    ['user' => 'pedidos@tabernalarioja.es', 'pass' => 'rioja2025'],
    ['user' => 'contacto@alfarogrill.es', 'pass' => 'alfaro2025']
];

foreach ($credenciales as $c) {
    echo "Probando: {$c['user']} / {$c['pass']}\n";
    $rest = $modelo->obtenerPorCredenciales($c['user'], $c['pass']);
    if ($rest) {
        echo "✅ ÉXITO: Usuario encontrado. CodRes: " . $rest['CodRes'] . "\n";
    } else {
        echo "❌ FALLO: Credenciales incorrectas.\n";
    }
}

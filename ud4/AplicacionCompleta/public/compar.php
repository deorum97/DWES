<?php
    require_once "../vendor/autoload.php";
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    $codProd = (int)($_POST['CodProd'] ?? '');
    $cantidad = (int)($_POST['cantidad'] ?? 0);
    $cat = (int)($_POST['cat'] ?? '');

    header('Location: tabla_lectura.php' . ($cat !== '' ? '?cat=' . (int)($_POST['cat']) : ''));
    exit;
?>
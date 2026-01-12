<?php
session_start();

unset($_SESSION['carrito'][$_GET['codProd']]);

header("Location: carrito.php");
exit;

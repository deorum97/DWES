<?php
	require "../vendor/autoload.php";
	session_start();

    if(!isset($_SESSION["id_usuario"]) || !isset($_SERVER['REQUEST_METHOD'])){
		header("Location:index.php");
	}

	use Jrm\EvUd1\GestorMascotas;

    $gestor = new GestorMascotas();

    if($_SERVER["REQUEST_METHOD"]==="GET"){
        $id = (int)$_GET["id"] ?? 0;
        if($id > 0){
            try{
                $gestor->eliminar($id);

                header("Location:ListadoMascotas.php");
                exit;

            }catch (\PDOException $e){
                die('Error al borrar: ' . $e->getMessage());
            }
        }
        

    }else{
        header("Location:index.php");
    }
    
<?php
    require "../vendor/autoload.php";

    use Jrm\Bbdd\GestorLectura;

    $gestor = new GestorLectura();

    if($_SERVER["REQUEST_METHOD"]==="GET"){
        $id = (int)$_GET["id"] ?? 0;
        if($id > 0){
            try{
                $gestor->eliminar($id);

                header("Location:tabla_lectura.php");
                exit;

            }catch (\PDOException $e){
                die('Error al borrar: ' . $e->getMessage());
            }
        }
        

    }else{
        header("Location:index.php");
    }
    
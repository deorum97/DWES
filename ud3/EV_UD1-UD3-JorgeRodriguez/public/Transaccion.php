<?php
	require '../vendor/autoload.php';
    session_start();

    if(!isset($_SESSION["id_usuario"])){
        header("Location:index.php");
    }

    use Jrm\EvUd1\GestorMascotas;

    $gestor = new GestorMascotas();

    if($_SERVER["REQUEST_METHOD"]==="GET"){
    	if($_GET["tran"]==="A"){
			$animales = [
				['id'=> 8,'nombre' => 'carl', 'tipo' => 'gato', 'fecha_nacimiento' => "2013-05-07", 'foto_url' => "../public/img/perro2.jpeg", 'id_persona' => 1],
				['id'=> 9,'nombre' => 'carl1', 'tipo' => 'gato', 'fecha_nacimiento' => "2013-05-07", 'foto_url' => "../public/img/perro2.jpeg", 'id_persona' => 1],
				['id'=> 10,'nombre' => 'carl2', 'tipo' => 'gato', 'fecha_nacimiento' => "2013-05-07", 'foto_url' => "../public/img/perro2.jpeg", 'id_persona' => 1]
			];
		}elseif ($_GET["tran"]==="B") {
			$animales = [
				['id'=> 8,'nombre' => 'carl', 'tipo' => 'gato', 'fecha_nacimiento' => "2013-05-07", 'foto_url' => "../public/img/perro2.jpeg", 'id_persona' => 1],
				['id'=> 8,'nombre' => 'carl', 'tipo' => 'gato', 'fecha_nacimiento' => "2013-05-07", 'foto_url' => "../public/img/perro2.jpeg", 'id_persona' => 1]
			];
		}
		try{
			foreach ($animales as $mascota) {
				$gestor->testTransaccion($mascota);
			}
			header("Location:index.php");
		}catch(\PDOException $e){
			$error= "Error al insertar los animales: ".$e->getMessage();
		}
    }

    
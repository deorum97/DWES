<?php
    require "../vendor/autoload.php";
    session_start();
    
    if(!isset($_SESSION["id_usuario"])){
        header("Location:index.php");
    }
    use Jrm\EvUd1\GestorMascotas;
    $gestor = new GestorMascotas();
    $error = "";

    if($_SERVER["REQUEST_METHOD"]==="POST"){
    	$fichero= $_FILES["foto"];
    	if(!isset($fichero) || $fichero['error'] === UPLOAD_ERR_NO_FILE){
	    	$error ="Fallo al cargar la imagen";
		}else{
            if(!file_exists($rutaFichero)){
                $res = move_uploaded_file($fichero["tmp_name"], $rutaFichero);
            }
			
			$foto = "../public/img/".$fichero["name"];
		    try {
		        $mascota = $gestor->insertar([
	                'nombre' => $_POST['nombre'] ?? '',
	                'tipo' => $_POST['tipo'] ?? '',
	                'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
	                'foto_url' => $foto,
	                'id_persona' => $_POST['responsable']
	            ]);
	            header("Location:index.php");
		    } catch (\Exception $e) {
		        die('Error al obtener la mascota: ' . $e->getMessage());
		    }
		}
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir nueva Mascota</title>

    <link href="css/bootstrap.min_002.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* No modificamos .container de Bootstrap */
        .form-wrapper {
            max-width: 700px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

    <div class="container form-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card p-4">

                    <h2 class="mb-3">Añadir Mascota</h2>

                    <form method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="nombre mascota" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="nueva_foto" class="form-label">Tipo:</label><br>
                            <select name="tipo" class="form-control">
                            	<option value="gato">gato</option>
                            	<option value="perro">perro</option>
                            	<option value="tortuga">tortuga</option>
                            	<option value="agaproni">agaporni</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha de nacimiento" class="form-label">Fecha nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <?php
                            	echo "<p style='color red'>$error</p>";
                            ?>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="responsable mascota" class="form-label">responsable:</label>
                            <select name="responsable">
                            	<?php
                            		try{
                            			$responsables = $gestor->listarResponsables();
                            			foreach ($responsables as $res ) {
                            				echo "<option value=".$res->id.">".$res->nombre." ".$res->apellido."</option>";
                            			}
                            		}catch(PDOException $e){

                            		}
                            	?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Registrar mascota
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
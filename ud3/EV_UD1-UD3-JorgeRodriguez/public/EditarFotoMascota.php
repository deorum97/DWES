<?php
    require "../vendor/autoload.php";
    session_start();
    
    if(!isset($_SESSION["id_usuario"]) || !isset($_GET['id'])){
        header("Location:index.php");
    }

    use Jrm\EvUd1\GestorMascotas;

    $gestor = new GestorMascotas();

    try {
        $id = $_GET['id'];
        $mascota = $gestor->getMascota($id);
    } catch (\Exception $e) {
        die('Error al obtener la mascota: ' . $e->getMessage());
    }

    $error = "";

    if($_SERVER["REQUEST_METHOD"]==="POST"){

        $id =$_POST['id'];
        $directorio = "../public/img/";

        $fichero= $_FILES["nueva_foto"];
        $rutaFichero = $directorio.$fichero["name"];

        if(!isset($fichero) || $fichero['error'] === UPLOAD_ERR_NO_FILE){
          $error="Fallo al cargar la imagen";

        }else{ 
            $extension = pathinfo($fichero["name"])["extension"];

            if($extension === "jpeg"){

                if(!file_exists($rutaFichero)){
                    $res = move_uploaded_file($fichero["tmp_name"], $rutaFichero);
                    if($res){
                        try {
                            $mascota = $gestor->actualizarFoto($id,$rutaFichero);
                            header("Location:ListadoMascotas.php");
                            exit;
                        } catch (\Exception $e) {
                            $error='Error al actualizar foto: ' . $e->getMessage();
                            header("Location:EditarFotoMascota.php?id=$id&error=$error");
                        }
                        header("Location:ListadoMascotas.php");
                    }else{
                        $error="error al subir la foto al servidor";
                    }
                }
                try {
                    $mascota = $gestor->actualizarFoto($id,$rutaFichero);
                    header("Location:ListadoMascotas.php");
                    exit;
                } catch (\Exception $e) {
                    $error='Error al actualizar foto: ' . $e->getMessage();
                }
                header("Location:ListadoMascotas.php");
            }else{
                 $error="La imagen debe de ser de tipo jpeg o ya existe";
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
    <title>Cambiar Foto Mascota</title>

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

                    <h2 class="mb-3">Cambiar Foto</h2>

                    <p><strong>Nombre:</strong> <?=htmlspecialchars($mascota["nombre"])?></p>
                    <p><strong>Tipo:</strong> <?=htmlspecialchars($mascota["tipo"])?></p>
                    <p><strong>Fecha de Nacimiento:</strong> <?=htmlspecialchars($mascota["fecha_nacimiento"])?></p>

                    <img src="<?=htmlspecialchars($mascota["foto_url"])?>"
                         alt="Foto de Rampante"
                         class="img-fluid mb-3"
                         style="max-width: 200px;">

                    <form method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?=htmlspecialchars($mascota["id"])?>">

                        <div class="mb-3">
                            <?php
                                echo "<p style='color:red'>$error</p>"
                            ?>
                            <label for="nueva_foto" class="form-label">Seleccione nueva foto:</label>
                            <input type="file" name="nueva_foto" id="nueva_foto" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Cambiar Foto
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
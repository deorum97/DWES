<?php
    require "../vendor/autoload.php";
    session_start();
    if(!isset($_SESSION["id_usuario"])){
		header("Location:index.php");
	}

    use Jrm\Bbdd\GestorLectura;

    $gestor = new GestorLectura();

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        try{
            $id = $gestor->insertar([
                'id_usuario' => $_SESSION['id_usuario'],
                'titulo_libro' => $_POST['titulo_libro'] ?? '',
                'autor' => $_POST['autor'] ?? '',
                'paginas' => $_POST['paginas'] ?? 0,
                'terminado' => isset($_POST['terminado']) ? 1 : 0,
                'fecha_lectura' => $_POST['fecha_lectura'] ?: null
            ]);
            header("Location:tabla_lectura.php");
            exit;
        }catch (\PDOException $e){
            die('Error al añadir el libro: ' . $e->getMessage());
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion de libro</title>
    <link rel="stylesheet" href="css/style_form.css">
</head>
<body>
    <main>
        <div class="flip-card">
            <div class="title">Log in</div>
            <form class="flip-card__form" method="post">
                <?php if(!empty($error)): ?>
                    <p style="color:red"><?=htmlspecialchars($error)?></p>
                <?php endif; ?>
                <input name="accion" type="hidden">
                <input class="flip-card__input" name="titulo_libro" placeholder="Titulo del libro" type="text">
                <input class="flip-card__input" name="autor" placeholder="Autor del libro" type="text">
                <input class="flip-card__input" name="paginas" placeholder="Número de páginas" type="number">
                <label for="terminado">Terminado:  
                    <input name="terminado" placeholder="Usuario" type="checkbox">
                </label>
                <input class="flip-card__input" name="fecha_lectura" placeholder="Contraseña" type="date">
                <button class="flip-card__btn" type="submit">Crear</button>
            </form>
        </div>
    </main>
</body>
</html>
<?php
	require '../vendor/autoload.php';
	
	session_start();
    if(!isset($_SESSION["id_usuario"])){
        header("Location:index.php");
    }

	use Jrm\Bbdd\GestorLectura;
	$error = "";


	if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["transaccion"])){
		$gestor = new GestorLectura();
		if($_POST["transaccion"]==="A"){
			$registros = [
				['titulo_libro' => 'Las cronicas de narnia', 'autor' => 'un leon', 'paginas' => 100],
				['titulo_libro' => 'Algo de niebla', 'autor' => 'arena y algo', 'paginas' => 200],
			];
		}else{
			$registros = [
				['titulo_libro' => 'RompePantallas', 'autor' => 'marcos', 'paginas' => 100],
				['titulo_libro' => 'RompePantallas', 'autor' => 'otro martcos', 'paginas' => 200],
			];
		}
		try{
			$gestor->testTransaccion($registros);
		}catch(\PDOException $e){
			$error= "Error al insertar el libro: ".$e->getMessage();
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pagina principal</title>
	<link rel="stylesheet" href="css/style_tabla.css">
</head>
<body>
	<main>
		<section class="table-box">
			<div class="styled-table">
				<h1>Página principal</h1>
				<a href="tabla_lectura.php">
					<button class="crear_libro_btn" type="button"><b>Ver libros</b></button>
				</a>
				<form method="post">
					<?php if(!empty($error)){ ?>
						<p style="color:red"><?php echo htmlspecialchars($error)?></p>
					<?php } ?>
					<button class="crear_libro_btn" type="submit" value="A" name="transaccion"><b>Transacciones A</b></button>
					<button class="crear_libro_btn" type="submit" value="B" name="transaccion"><b>Transaciones B</b></button>
				</form>
			</div>
		</section>
	</main>
</body>
</html>
<?php
	require "../vendor/autoload.php";
	use Jrm\bbdd\tools;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Archivo de entrada a la aplicación: formulario de login</title>
</head>
<body>
	<main>
		<section>
			<form action="login.php" method="post">
				<label>Usuario: 
					<input type="text" name="usuario">
				</label>
				<label>Contraseña: 
					<input type="text" name="clave">
				</label>
			</form>
		</section>
	</main>
</body>
</html>
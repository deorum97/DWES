<?php
	require '../vendor/autoload.php';

	use Jrm\Bbdd\GestorLectura;

	$gestor = new GestorLectura();

	try {
		$registros = $gestor->listar();
	} catch (\Exception $e) {
		die('Error al obtener registros: ' . $e->getMessage());
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Archivo de entrada a la aplicación: formulario de login</title>
		<link rel="stylesheet" href="css/style_tabla.css">
	</head>
	<body>
		<main>
			<section class="table-box">
				<table class="styled-table">
					<tr>
						<th>Titulo del libro</th>
						<th>Autor del libro</th>
						<th>Pagina</th>
						<th>Terminado</th>
						<th>Fecha de lectura</th>
						<th>Acciones</th>
					</tr>
					<?php foreach( $registros as $reg):	?>
						<tr>
							<td><?=htmlspecialchars($reg->titulo_libro)?></td>
							<td><?=htmlspecialchars($reg->autor)?></td>
							<td><?=htmlspecialchars($reg->paginas)?></td>
							<td><?=htmlspecialchars($reg->terminado)?></td>
							<td><?=htmlspecialchars($reg->fecha_lectura)?></td>
							<td>
								<a href="editar_libro.php?id=<?=urlencode($reg->id_libro)?>">
									<button class="editar_libro_btn" type="submit"><b>Editar libro</b></button>
								</a>
								<a href="borrar_libro.php?id=<?=urlencode($reg->id_libro)?>">
									<button class="borrar_libro_btn" type="submit"><b>Borrar libro</b></button>
								</a>
							</td>
						</tr>
					<?php endforeach;?>
				</table>
				<a href="crear_libro.php">
					<button class="crear_libro_btn" type="submit"><b>Crear libro</b></button>
				</a>
				<a href="../tools/unlogin.php">
					<button class="desloguear" type="submit"><b>Desloguaerse</b></button>
				</a>
			</section>
		</main>
	</body>
</html>
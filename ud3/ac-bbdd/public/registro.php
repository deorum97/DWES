<?php
    require '../vendor/autoload.php';

    use Jrm\Bbdd\tools\Conexion;

    session_start();

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $usuario = $_POST["usuario"];
        $clave = $_POST["clave"];
        $claveR = $_POST["claveR"];

        try{
            $pdo = Conexion::conectar();
            $sqlSelect ="SELECT * FROM usuarios WHERE nombre_usuario = '$usuario'";

            $stmtSel = $pdo->prepare($sqlSelect);
            $stmtSel->execute();

            $resultSel = $stmtSel->setFetchMode(PDO::FETCH_ASSOC); 
            $resultSel = $stmtSel->fetchAll();

            if(!empty($resultSel)){
                $usuarioErr = "Ese usuario ya esta en uso";
            }else if($clave===$claveR){
                $sqlInsert = "INSERT INTO usuarios(nombre_usuario, clave_usuario) VALUES ('$usuario', '$clave')";
                $pdo->exec($sqlInsert);
                $_SESSION["id_usuario"] = $result["id_usuario"];
                $_SESSION["usuario"] = $result["nombre_usuario"];
                $pdo=null;
                header("Location:index.php");
            }else {
                $claveRErr="La contraseña que has puestos deben ser iguales";
            }

            }catch(PDOException $e) {
                $error = 'Error durante el registro: ' . $e->getMessage();
        }

        $pdo=null;
    }

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
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
					<input class="flip-card__input" name="usuario" placeholder="Usuario" type="text">
					<input class="flip-card__input" name="clave" placeholder="Contraseña" type="password">
                    <input class="flip-card__input" name="claveR" placeholder="Contraseña" type="password">
					<button class="flip-card__btn" type="submit">Registrate</button>
				</form>
			</div>
		</main>
    </body>
</html>

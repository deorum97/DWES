<?php
    require '../vendor/autoload.php';

    use Jrm\Bbdd\tools\Conexion;

    session_start();
    if(isset($_SESSION["id_usuario"])){
        header("Location:principal.php");
    }

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $usuario = $_POST["usuario"];
        $clave = $_POST["clave"];

        try{
            $pdo = Conexion::conectar();

            $sql= "SELECT * FROM usuarios where nombre_usuario = :usuario AND clave_usuario=:clave";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":usuario" => $usuario,
                ":clave" => $clave
                ]);

            $result = $stmt->fetch();
            print_r($result);

            if(!empty($result)){
                $_SESSION["id_usuario"] = $result["id_usuario"];
                $_SESSION["usuario"] = $result["nombre_usuario"];
                header("Location:principal.php");
            }else{
                $error = 'Usuario o contraseña incorrectos.';
            }

        }catch(PDOException $e) {
            $error = 'Error durante la autenticación: ' . $e->getMessage();
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
					<button class="flip-card__btn" type="submit">Logueate</button>
					<a href="registro.php">
					    <button  class="flip-card__btn" type="button">Registrate</button>
                    </a>
				</form>
			</div>
		</main>
    </body>
</html>

<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

    <h1><?php echo $datos['titulo']; ?></h1>

    <?php if (isset($datos['error'])) { ?>
        <p style="color:red;">Ha habido un error en el loguin</p>
    <?php } ?>

	<form method="post" action="<?php echo RUTA_URL."/usuarios/login";?>">
        <label>Correo:</label>
        <input type="email" name="email" required autocomplete="email" />

        <label>Clave:</label>
        <input
          type="password"
          name="clave"
          required
          autocomplete="clave"
        />

        <input type="submit" value="Login" />
    </form>
<?php require_once RUTA_APP.'/vistas/inc/footer.php';?>
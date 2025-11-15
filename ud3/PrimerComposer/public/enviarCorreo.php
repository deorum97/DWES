<?php
    require "../vendor/autoload.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <form action="../tools/mailer.php" enctype="multipart/form-data" method="post">
            <label for="">Destinatario
                <input type="email" name="correo" id="">
            </label>
            <label for="">Asunto
                <input type="text" name="asunto">
            </label>
            <label for="">Cuerpo del mensaje</label>
            <textarea name="cuerpo" id="" rows="10" cols="50"></textarea><br>
            <label for="">Archivo a enviar
                <input type="file" name="fichero" id="">
            </label>
            <input type="submit" value="Enviar">
        </form>
    </main>
</body>
</html>
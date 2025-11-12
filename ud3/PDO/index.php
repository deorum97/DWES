<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>

        <h2>Logueo</h2>
        <form action="login.php" method="post">
            <label>Usuario:<input type="text" name="usuario"></label>
            <label>Clave:<input type="password" name="clave"></label>
            <input type="submit" value="loguear">
        </form>

        <hr>

        <h2>Crear usuarios</h2>
        <form action="crud/createUsuario.php" method="post">
            <label>Usuario:<input type="text" name="usuario"></label>
            <label>Clave:<input type="password" name="clave"></label>
            <input type="submit" value="Crear">
        </form>
        
        <hr>

        <h2>Listar usuarios</h2>
        <form action="crud/readUsuarios.php" method="post">
            <label>Usuario:<input type="text" name="usuario"></label>
            <input type="submit" value="Listar">
        </form>
        
    </main>
</body>
</html>
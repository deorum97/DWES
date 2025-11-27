<?php
    require '../vendor/autoload.php';
    session_start();

    if(!isset($_SESSION["id_usuario"])){
        header("Location:index.php");
    }

    use Jrm\EvUd1\GestorMascotas;

    $gestor = new GestorMascotas();

    try {
        $registros = $gestor->listar();
    } catch (\Exception $e) {
        die('Error al obtener registros: ' . $e->getMessage());
    }

    try {
        $logs = $gestor->listarLogs();
    } catch (\Exception $e) {
        die('Error al obtener los logs: ' . $e->getMessage());
    }

    if($_SERVER["REQUEST_METHOD"]==="GET"){
        $lista = $_GET['lista'] ?? "";
        if($lista==="nomASC"){
            $columna = array_column($registros, 'nombre');
            array_multisort($columna,SORT_ASC,$registros);
            $gestor->insertarLog([
                "accion" => "busqueda realizada: nombre ascendente"
            ]);
            try {
                $logs = $gestor->listarLogs();
            } catch (\Exception $e) {
                die('Error al obtener los logs: ' . $e->getMessage());
            }

        }elseif ($lista==="nomDES") {
            $columna = array_column($registros, 'nombre');
            array_multisort($columna,SORT_DESC,$registros);
            $gestor->insertarLog([
                "accion" => "busqueda realizada: nombre descendente"
            ]);
            try {
                $logs = $gestor->listarLogs();
            } catch (\Exception $e) {
                die('Error al obtener los logs: ' . $e->getMessage());
            }
        }elseif ($lista==="tipASC") {
            $columna = array_column($registros, 'tipo');
            array_multisort($columna,SORT_ASC,$registros);
            $gestor->insertarLog([
                "accion" => "busqueda realizada: tipo ascendente"
            ]);
            try {
                $logs = $gestor->listarLogs();
            } catch (\Exception $e) {
                die('Error al obtener los logs: ' . $e->getMessage());
            }
        }elseif ($lista==="tipDES") {
            $columna = array_column($registros, 'tipo');
            array_multisort($columna,SORT_DESC,$registros);
            $gestor->insertarLog([
                "accion" => "busqueda realizada: tipo descendente"
            ]);
            try {
                $logs = $gestor->listarLogs();
            } catch (\Exception $e) {
                die('Error al obtener los logs: ' . $e->getMessage());
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="es"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Mascotas</title>
    <link href="css/bootstrap.min_002.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
    .container {
        /* Si quieres que el contenedor ocupe todo el ancho disponible, puedes eliminar max-width */
        max-width: 800px;
        margin: auto;
        padding: 20px;
        display: flex;           /* Añade flex para que las tarjetas se muestren en línea */
        flex-wrap: wrap;         /* Permite que las tarjetas se ajusten y pasen a la siguiente línea si no hay espacio */
        justify-content: space-between; /* Espacio entre tarjetas. Puedes ajustar según prefieras */
    }
    .card {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        /* Ancho de las tarjetas. Puedes ajustar según prefieras */
        width: calc(33% - 10px); /* Esto asume que quieres 3 tarjetas por fila y resta 20px por el espacio entre tarjetas */
        box-sizing: border-box; /* Asegura que el padding y el borde se incluyan en el ancho total de la tarjeta */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Listado de Mascotas</h1>
         <!-- Fragmento para mostrar mensajes -->
                <div>
            Ordenar por:
            <a href="ListadoMascotas.php?lista=nomASC" class="btn btn-success mt-2">Nombre ASC</a> |
            <a href="ListadoMascotas.php?lista=nomDES" class="btn btn-warning">Nombre DES</a> |
            <a href="ListadoMascotas.php?lista=tipASC" class="btn btn-success mt-2">Tipo ASC</a> |
            <a href="ListadoMascotas.php?lista=tipDES" class="btn btn-warning">Tipo DES</a>
        </div>

            <?php
                foreach ($registros as $reg) {
                    try {
                        $responsable = $gestor->getResponsable($reg->id_persona);
                    } catch (\Exception $e) {
                        die('Error al obtener el responsable: ' . $e->getMessage());
                    }
                    ?>
                    <div class="card">
                        <div class="card-content">
                            <img src="<?=htmlspecialchars($reg->foto_url)?>" alt="Foto de Bernabe" class="img-fluid" style="max-width: 200px;">
                            <div class="card-text">
                                <strong>Responsable:</strong> <?=htmlspecialchars($responsable[0])?><br>
                                <strong>Nombre:</strong> <?=htmlspecialchars($reg->nombre)?><br>
                                <strong>Tipo:</strong> <?=htmlspecialchars($reg->tipo)?><br>
                                <strong>Fecha de Nacimiento:</strong> <?=htmlspecialchars($reg->fecha_nacimiento)?>
                            </div>
                        </div>
                        <div>
                            <a href="EditarFotoMascota.php?id=<?=htmlspecialchars($reg->id)?>" class="btn btn-primary">Cambiar Foto</a> |
                            <a href="BorrarMascota.php?id=<?=htmlspecialchars($reg->id)?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                    <?php
                }
            ?>
             
    </div>
    <div class="text-center mt-3">
    <h1>Listados Efectuados (LOGs PERSISTENTES)</h1>
    <table style="margin-left: auto; margin-right: auto;">
        <thead>
            <tr>
                <th>Acción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($logs as $log) {
                    echo "<tr>";
                    echo "<td>".$log->accion."</td>";
                    echo "<td>".$log->fecha."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <h1>Navegación Web (LOGs de SESIÓN)</h1>
    <table style="margin-left: auto; margin-right: auto;">
        <thead>
            <tr>
                <th>Acción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_SESSION["array"])){
                    $array = $_SESSION['array'];
                    for ($i=1; $i < count($array) ; $i++) { 
                        echo "<tr>";
                        echo "<td>Acción $i</td>";
                        echo "<td>".$array[$i-1]."</td>";
                        echo "</tr>";
                    }
                }
            ?>
            
            
        </tbody>
    </table>
</div>

    <div class="text-center mt-3">
            <a href="AddMascota.php" class="btn btn-success mt-2">Registrar Mascota</a> | 
            <a href="../src/unLogin.php" class="btn btn-secondary mt-2">Cerrar Sesión</a>
    </div>
    <div class="text-center mt-3">
            <a href="Transaccion.php?tran=A" class="btn btn-success mt-2">Transaccion correcta</a> | 
            <a href="Transaccion.php?tran=B" class="btn btn-secondary mt-2">Transaccion incorrecta</a>
    </div>
    <script src="Listado%20Mascotas_files/bootstrap.min.js"></script>


</body></html>
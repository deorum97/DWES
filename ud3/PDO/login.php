<?php 
    require_once("connect.php");

     $usuario = $_POST["usuario"];
     $clave = $_POST["clave"];

    try{
        $sql= "SELECT * FROM usuarios where nombre = '$usuario' AND clave='$clave'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();

        if(!empty($result)){
            echo "logueo correcto";
        }else{
            echo "logueo incorrecto";
        }

    }catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn=null;
    echo "<br><a href='index.php'>Volver</a>";
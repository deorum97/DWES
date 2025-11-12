<?php
    require_once("../connect.php");

    $nombre=$_POST["usuario"];
    //$apellido=$_POST["apellido"];
    //$edad=$_POST["edad"];
    $clave=$_POST["clave"];
    //$rol=$_POST["rol"];
    //$email=$_POST["email"];

    try{
        $sql= "INSERT INTO usuarios(nombre,clave) VALUES ('$nombre','$clave')";

        $res = $conn->query($sql);

        if($res){
            echo "insert correcto <br>";
            echo "Filas insertadas: ".$res->rowCount()."<br>";
        }else print_r($conn->errorinfo());
        echo "Ultima fila añadida: ".$conn->lastInsertId()."<br>";

    }catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn=null;

    echo "<br><a href='../index.php'>Volver</a>";
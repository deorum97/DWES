<?php

    require_once("../connect.php");
    $usuario = $_POST["usuario"];

    try{
        $sql= "SELECT * FROM usuarios where nombre = '$usuario'";

        $usuarios = $conn->query($sql);
        foreach($usuarios as $row){
            print "Usuario: ".$row["nombre"]."||\t";
            print "Clave: ".$row["clave"]."\t";
        }
    }catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn=null;
    echo "<a href='../index.php'>Volver</a>";
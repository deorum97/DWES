<?php
  $servername = "localhost";
  $username = "root";
  $password = "mysql";
  $database = "dwes";
  $cadenaConexion= "mysql:host=$servername;dbname=$database";

  try {
    $conn = new PDO($cadenaConexion, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?> 
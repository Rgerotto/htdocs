<?php

// los paramentros de la conexion
$serverName = "127.0.0.1";
$userName = "root";
$password = "";
$dataBaseName = "colores";


$link = "mysql:host=$serverName; port=3309; dbname=$dataBaseName;"; 

try{
    $conn = new PDO($link, $userName, $password);

    //echo "Connection working!";
    //echo "Connection working!!!";
}
catch (PDOException $e){
    print("Error: " . $e->getMessage());

}
catch (Exception $e){
print("Error: " . $e->getMessage());
}




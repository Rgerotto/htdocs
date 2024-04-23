<?php

//connection
$serverName = "127.0.0.1";
$userName = "root";
$password = "";
$dbName = "Todo_list"; //name of database

$link = "mysql:host=$serverName; port=3309; dbname=$dbName;";

try{
    $conn = new PDO($link, $userName, $password);
}

catch (PDOException $e){
    print("Error: " . $e->getMessage());

}
catch (Exception $e){
print("Error: " . $e->getMessage());
}
?>
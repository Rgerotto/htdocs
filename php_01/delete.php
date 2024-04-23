<?php

include_once "connection.php";

$id_colores = $_GET["id_colores"];
 echo $id_colores;
echo $userName;

$delete = "delete from info_colores where id_colores=?";
$delete_prepare = $conn->prepare($delete);
$delete_prepare->execute([$id_colores]);

$delete_prepare = null;
$conn = null;

header("location:index.php");
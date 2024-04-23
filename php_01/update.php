<?php

include_once "connection.php";
include_once "colores.php";

echo $_GET["id_colores"]."<br />";
echo $_GET["usuario"]."<br />";

echo $_GET["color"];
echo $colores[$_GET["color"]];

$update = "UPDATE info_colores SET color = ?, usuario = ?, color_user = ? where id_colores = ?";
$update_prepare = $conn->prepare($update);
$update_prepare->execute([$_GET['color'], $_GET['usuario'], $colores[$_GET['color']], $_GET['id_colores']]);

$update_prepare = null;
$conn = null;

header("location:index.php");
//$colores = ["blue"=>"azul", "green"=>"verde", "red"=>"vermelho", "black"=>"negro", "yellow"=>"amarelo"];
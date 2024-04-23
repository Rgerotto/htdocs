<?php 

include_once "connection.php";

$id_ = $_GET['id_'];

$delete = "DELETE FROM todo_list_table where id_ = ?";
$delete_prepare = $conn->prepare($delete);
$delete_prepare->execute([$id_]);

$delete_prepare = null;
$conn = null;

?>
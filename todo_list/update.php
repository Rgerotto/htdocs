<?php

include_once "connection.php";

$update = "UPDATE todo_list_table SET title = ?, description = ?, date = ?, status = ? where id_ = ?";
$update_prepare = $conn->prepare($update);
$update_prepare->execute([$_GET['title'], $_GET['description'], $_GET['date'], $_GET['status'], $_GET['id_']]);

$update_prepare = null;
$conn = null;

header("location: index.php");

?>
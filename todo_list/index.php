<?php
//import connection.php file
include_once "connection.php";

$select = "select * from todo_list_table";

$select_prepare = $conn->prepare($select);
$select_prepare->execute();

$result_select = $select_prepare->fetchAll();

if($_POST){

    var_dump($_POST);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $insert = "INSERT INTO todo_list_table (title, description, date, status) values (?,?,?,?)";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$title, $description, $date, $status]);

    $insert_prepare = null;
    $conn = null;

    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/todo_list/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>

<body>
    <header>
        <h1>ToDo List Rafael</h1>
    </header>
    <main class="container">
        <!-- ======================LIST================ -->
        <section class="list">
        <h1>list of</h1>
            <?php foreach ($result_select as $row) : ?>
                <div>
                    
                    <div class="card">
                        <div class="description">
                        <?php echo $row["title"] . " | " . $row["description"] . " | " . $row["date"] . " | " . $row["status"]?>
                        </div>
                        <div class="edit">
                        <i class="fa-solid fa-pen"></i>
                        <i class="fa-solid fa-trash"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
        <section class="form-container">
            <h1>form</h1>
             <?php if(!$_GET) : ?>
            <form class="form"method="post">
                <label for="title">Title:</label>
                <input type="text" name="title">
                <label for="description">Description:</label>
                <input type="text" name="description">
                <label for="date">Date:</label>
                <input type="date" name="date">
                <label for="status">Status:</label>
                <select name="status" id="">
                    <option selected>Choose</option>
                    <option value="urgent">Urgent</option>
                    <option value="pendent">Pendent</option>
                    <option value="doing">Doing</option>
                    <option value="done">Done</option>
                </select>
                <div class="btn-container">
                    <button class="btn btn-send" type="submit">Send</button>
                    <button class="btn btn-reset" type="reset">Reset</button>
                </div>
            </form>
           <?php endif ?>

        </section>
    </main>
</body>

</html>
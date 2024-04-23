<?php

include_once "connection.php";
include_once "colores.php";
//$colores = ["blue"=>"azul", "green"=>"verde", "red"=>"vermelho", "black"=>"negro", "yellow"=>"amarelo"];


$select = "SELECT * FROM info_colores";

$select_prepare = $conn->prepare($select);
$select_prepare->execute();

$resultado_select = $select_prepare->fetchAll();

//var_dump($resultado_select);

/*  foreach($reultado_select as $key => $value) {
    echo $value['color']. "<br>";
} */

if ($_POST) {

    var_dump($_POST);
    $color = $_POST["color"];
    $usuario = $_POST["usuario"];
   

    $insert = "insert into info_colores (color, usuario, color_user) values (?,?,?)";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$color, $usuario, $colores[$color]]);

    $insert_prepare = null;
    $conn = null;

    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <header>
        <h1 class="text-center">Nuetro colores favoritos</h1>
    </header>

    <main class="container">
        <div class="row gx-5">
            <section class="col-sm-6 section1">
                <?php foreach ($resultado_select as $row) : ?>
                    <div class="row alert" style="color: white; background-color:<?= $row["color"] ?>">
                        <div class="col-sm-9 barra">

                            <?= $row["usuario"] . " : " . $row["color_user"] ?>
                        </div>
                        <div class="col-sm-3 text-end under">
                            <a href="index.php?id_colores=<?= $row["id_colores"] ?>&usuario=<?= $row["usuario"] ?>">✏️</a>
                            <a href="delete.php?id_colores=<?= $row["id_colores"] ?>">🗑️</a>
                        </div>
                    </div>
                <?php endforeach ?>

            </section>
            <section class="col-sm-6 section2">

                <!-- =====================METHOD GET================== -->
                <?php if ($_GET) : ?>

                    <form method="GET" action="update.php">
                        <h4>get</h4>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="usuario" value="<?=$_GET ['usuario']?>">
                            <input type="hidden" name="id_colores" value="<?=$_GET ['id_colores']?>">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color:</label>
                            <select name="color" id="color">
                                <option value="blue" selected>Azul</option>
                                <option value="green">Verde</option>
                                <option value="red">Vermelho</option>
                                <option value="black">Negro</option>
                                <option value="yellow">Amarelo</option>
                            </select>
                        </div>
                        <div class="row gap-3">
                            <button type="submit" class=" col btn btn-primary">Submit</button>
                            <button type="reset" class=" col btn btn-danger">Cancel</button>
                        </div>
                        <div class="my-3">
                            <p class="text-center">
                            <a href="index.php">Refresh</a>
                            </p>
                    </form>
                <?php endif ?>


                <?php if (!$_GET) : ?>
                    <form method="post">
                        <h4>post</h4>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="usuario">
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color:</label>
                            <select name="color" id="color">
                                <option value="blue" selected>Azul</option>
                                <option value="green">Verde</option>
                                <option value="red">Vermelho</option>
                                <option value="black">Negro</option>
                                <option value="yellow">Amarelo</option>
                            </select>
                        </div>
                        <div class="row gap-3">
                            <button type="submit" class=" col btn btn-primary">Submit</button>
                            <button type="reset" class=" col btn btn-danger">Cancel</button>
                        </div>
                    </form>
                <?php endif ?>

            </section>
        </div>
    </main>

</body>

</html>
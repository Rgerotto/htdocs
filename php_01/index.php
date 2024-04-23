<?php

include_once "connection.php";

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

    $insert = "insert into info_colores (color, usuario) values (?,?)";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$color, $usuario]);

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
        <h1>hola</h1>
    </header>

    <main class="container">
        <div class="row">
            <section class="col-sm-6 section1">
                <?php foreach ($resultado_select as $row) : ?>
                    <div class="alert alert-<?php if ($row["color"] == "azul") {
                                                echo "primary";
                                            } elseif ($row["color"] == "verde") {
                                                echo "success";
                                            } else {
                                                echo "danger";
                                            }
                                            ?>" role="alert">
                        <?= $row["usuario"] . " : " . $row["color"] ?>
                    </div>
                <?php endforeach ?>

            </section>
            <section class="col-sm-6 section2">
                <form method="post">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" name="usuario" class="form-control" id="usuario" aria-describedby="usuario">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color:</label>
                        <select name="color" id="color">
                            <option value="azul" selected>Azul</option>
                            <option value="verde">Verde</option>
                            <option value="vermelho">Vermelho</option>
                            <option value="negro">Negro</option>
                            <option value="amarelo">Amarelo</option>
                        </select>
                    </div>
                    <div class="row gap-3">
                        <button type="submit" class=" col btn btn-primary">Submit</button>
                        <button type="reset" class=" col btn btn-danger">Cancel</button>
                    </div>
                </form>


            </section>
        </div>
    </main>

</body>

</html>
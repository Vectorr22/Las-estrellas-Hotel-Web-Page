<?php
session_start();
include("php/connection.php");
include("php/functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['alta'])) {
    $pak_name = $_POST['pak_name'];
    $pak_price = $_POST['pak_price'];
    $pak_description = $_POST['pak_description'];
    $pak_city = $_POST['pak_city'];
    if( !empty($pak_name) && !empty($pak_price) && !empty($pak_description) && !empty($pak_city) )
    {
        $query = "INSERT INTO `user_packagedata`(`pak_name`, `pak_price`, `pak_description`, `pak_city`) VALUES ('$pak_name','$pak_price','$pak_description','$pak_city')";
        $result = mysqli_query($conexion,$query);
        if($result)
        {
            echo("Alta correcta");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Hotel las Estrellas | Administrador</title>

</head>

<body style="color: black;">
    <header>
        <nav id="navbar" class="py-30">
            <div class="container">
                <h1 class="logo"><a href="index.php">Hotel las Estrellas</a></h1>
                <ul>
                    <li><a href="adminCRUD.php" style="color:blue;">Panel de control</a></li>
                    <li><a href="php/logout.php" style="color:blue;">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <h2 class="crud_header">Alta de paquetes</h2>
        <form method="post" class="admin_altas">
            <div>
                <div class="correo_login">
                    <input type="text" name="pak_name">
                    <label>Nombre del paquete</label>
                </div>
                <div class="correo_login">
                    <input type="number" name="pak_price">
                    <label>Precio del paquete</label>
                </div>
                <div class="correo_login">
                    <input type="text" name="pak_description">
                    <label>Descripcion del paquete</label>
                </div>
                <div class="correo_login">
                    <input type="text" name="pak_city">
                    <label>Ciudad</label>
                </div>
                <div class="buton_login">
                    <input type="submit" value="Alta" name="alta">
                </div>
            </div>
        </form>

</body>
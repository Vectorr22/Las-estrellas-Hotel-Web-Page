<?php
session_start();
include("php/connection.php");
include("php/functions.php");

$rooms_data;
$options = ''; // Initialize an empty string to store the options

$query = "SELECT * from user_packagedata";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($rooms_data = mysqli_fetch_assoc($result)) {
        // Append each option to the $options string
        $options .= "<option value='{$rooms_data['pak_id']}'>{$rooms_data['pak_name']}</option>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['borrar'])) {
    $id = $_POST['combobox'];
    $query = "DELETE FROM `user_packagedata` WHERE `pak_id` = '$id'";
    $result = mysqli_query($conexion,$query);
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

    <h2 class="crud_header">Baja de paquetes</h2>
    <br><br>
    <form method="post" class="admin_altas">
        <div>
            <div class="delete_container">
                <label>
                    Selecciona un ID de habitacion a eliminar:
                </label>
            </div>
            <br><br>
            <div class="delete_container">
                <select id="combobox" name="combobox">
                    <option>----</option>
                    <?php echo $options; ?>
                </select>
            </div>
            <br><br>
            <div class="buton_login">
                <input type="submit" value="BORRAR" name="borrar">
            </div>
        </div>
    </form>



</body>
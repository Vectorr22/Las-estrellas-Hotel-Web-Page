<?php
session_start();
include("php/connection.php");
include("php/functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['user_name'];
    $userphone = $_POST['user_phone'];
    $useremail = $_POST['user_email'];
    $password = $_POST['user_password'];


    if (!empty($username) && !empty($password)) {
        $query = "INSERT INTO `user_data` (`user_name`, `user_email`, `user_phone`, `user_password`) 
        VALUES ('$username', '$useremail', '$userphone', '$password')";
        mysqli_query($conexion,$query);
        header("Location: login.php");
        die;

    } else {
        echo "Información de registro incorrecta";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="body_login">
    <container>
        <div class="login_container">
            <h1>Registrarse</h1>
            <div class="image_login">
                <img src="img/user.png" alt="login_image">
            </div>
            <form method="post">
                <div class="correo_login">
                    <input type="text" required name="user_name">
                    <label>Nombre Completo</label>
                </div>
                <div class="correo_login">
                    <input type="tel" required name="user_phone">
                    <label>Telefono</label>
                </div>
                <div class="correo_login">
                    <input type="text" required name="user_email">
                    <label>Correo Electrónico</label>
                </div>
                <div class="correo_login">
                    <input type="text" required name="user_password">
                    <label>Contraseña</label>
                </div>
                <div class="registrar_login">
                    ¿Ya tienes cuenta? <a href="login.php">Ingresa aquí</a>
                    <br><br>
                </div>
                <div class="buton_login">
                    <input type="submit" value="Registrarse">
                </div>
            </form>
        </div>

    </container>


</body>

</html>
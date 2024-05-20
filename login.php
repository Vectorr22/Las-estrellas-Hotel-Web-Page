<?php
session_start();
include("php/connection.php");
include("php/functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    if (!empty($email) && !empty($password)) {
        $query = "SELECT * from user_data WHERE user_email = '$email' limit 1";
        $result = mysqli_query($conexion, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['user_password'] === $password) {
                $_SESSION['user_data'] = $user_data;
                $_SESSION['user_type'] = "client";
                header("Location: contact.php");
                exit();
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="body_login">
    <container>
        <div class="login_container">
            <h1>Iniciar Sesion</h1>
            <div class="image_login">
                <a href="loginAdmin.php"><img src="img/user.png" alt="login_image"></a>
            </div>
            <form method="post">
                <div class="correo_login">
                    <input type="text" required name="user_email">
                    <label>Correo Electrónico</label>
                </div>
                <div class="correo_login">
                    <input type="text" required name="user_password">
                    <label>Contraseña</label>
                </div>
                <div class="buton_login">
                    <input type="submit" value="Login" name="login">
                </div>
                <div class="registrar_login">
                    ¿No tienes cuenta? <a href="register.php">Registrate</a>
                </div>
            </form>
        </div>

    </container>


</body>

</html>
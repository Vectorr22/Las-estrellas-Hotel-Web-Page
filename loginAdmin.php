<?php
session_start();
include("php/connection.php");
include("php/functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];
    if (!empty($user) && !empty($password)) {
        $query = "SELECT * from user_admin WHERE admin_username = '$user' limit 1";
        $result = mysqli_query($conexion, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $admin_data = mysqli_fetch_assoc($result);
            if ($admin_data['admin_password'] === $password) {
                $_SESSION['admin_data'] = $admin_data;
                $_SESSION['user_type'] = "admin";
                header("Location: adminCRUD.php");
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
            <h1>Administrador</h1>
            <form method="post">
                <div class="correo_login">
                    <input type="text" required name="username">
                    <label>Username</label>
                </div>
                <div class="correo_login">
                    <input type="text" required name="password">
                    <label>Contraseña</label>
                </div>
                <div class="buton_login">
                    <input type="submit" value="Login" name="login">
                </div>
                <div class="registrar_login">
                    ¿Eres usuario normal? <a href="login.php">Logear</a>
                </div>
            </form>
        </div>

    </container>


</body>

</html>
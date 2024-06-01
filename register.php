<?php
session_start();
include("php/connection.php");
include("php/functions.php");
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['user_name'];
    $userphone = $_POST['user_phone'];
    $useremail = $_POST['user_email'];
    $password = $_POST['user_password'];

    if (!empty($username) && !empty($password) && !empty($useremail)) {
        // Check if email already exists
        $query = "SELECT * FROM `user_data` WHERE `user_email` = '$useremail' LIMIT 1";
        $result = mysqli_query($conexion, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $error_message = "Este correo electrónico ya está registrado.";
        } else {
            // Insert new user
            $query = "INSERT INTO `user_data` (`user_name`, `user_email`, `user_phone`, `user_password`) 
                      VALUES ('$username', '$useremail', '$userphone', '$password')";
            mysqli_query($conexion, $query);
            header("Location: login.php");
            die;
        }
    } else {
        $error_message = "Información de registro incorrecta.";
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
    <script type="text/javascript">
        function validate() {
            let nameValue = document.getElementById("user_name").value;
            let name = document.getElementById("user_name");
            let phoneValue = document.getElementById("user_phone").value;
            let phone = document.getElementById("user_phone");
            let emailValue = document.getElementById("user_email").value;
            let email = document.getElementById("user_email");
            let passwordValue = document.getElementById("user_password").value;
            let password = document.getElementById("user_password");
            let errorMessage = document.getElementById("error-message");

            let reName = /^[a-zA-ZÀ-ÿ\s]{2,}$/;
            let rePhone = /^(\+52\s?)?(\d{2,3}\s?\d{3,4}[-\s]?\d{4})$/;
            let reEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
            let rePassword = /^(?=(?:.*[A-Z]){3,})(?=.*\d)[A-Za-z\d]{8,}$/;

            if (!reName.test(nameValue)) {
                name.style.border = "red solid 3px";
                errorMessage.textContent = "Por favor, introduce un nombre completo válido.";
                return false;
            } else {
                name.style.border = "";
            }

            if (!rePhone.test(phoneValue)) {
                phone.style.border = "red solid 3px";
                errorMessage.textContent = "Por favor, introduce un número de teléfono válido.";
                return false;
            } else {
                phone.style.border = "";
            }

            if (!reEmail.test(emailValue)) {
                email.style.border = "red solid 3px";
                errorMessage.textContent = "Por favor, introduce un correo electrónico válido.";
                return false;
            } else {
                email.style.border = "";
            }

            if (!rePassword.test(passwordValue)) {
                password.style.border = "red solid 3px";
                errorMessage.textContent = "La contraseña debe tener al menos 8 caracteres, 3 letras mayúsculas y 1 número.";
                return false;
            } else {
                password.style.border = "";
            }

            errorMessage.textContent = "";
            return true;
        }
    </script>
</head>

<body class="body_login">
    <container>
        <div class="login_container">
            <h1>Registrarse</h1>
            <div class="image_login">
                <img src="img/user.png" alt="login_image">
            </div>
            <form method="post" onsubmit="return validate();">
                <div class="correo_login">
                    <input type="text" required id="user_name" name="user_name">
                    <label>Nombre Completo</label>
                </div>
                <div class="correo_login">
                    <input type="tel" required id="user_phone" name="user_phone">
                    <label>Telefono</label>
                </div>
                <div class="correo_login">
                    <input type="text" required id="user_email" name="user_email">
                    <label>Correo Electrónico</label>
                </div>
                <div class="correo_login">
                    <input type="password" required id="user_password" name="user_password">
                    <label>Contraseña</label>
                </div>
                <div id="error-message" style="color: red; margin-bottom: 10px;">
                    <?php if (!empty($error_message)) echo $error_message; ?>
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

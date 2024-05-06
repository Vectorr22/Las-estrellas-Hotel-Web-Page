<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Si el usuario ya inició sesión, redirigirlo a la página de bienvenida
    header("Location: welcome.php");
    exit;
}

// Verificar si se ha enviado un formulario de inicio de sesión
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Verificar las credenciales de inicio de sesión (aquí debes agregar tu lógica de autenticación)
    $username = "usuario"; // Cambia esto por el nombre de usuario real
    $password = "contraseña"; // Cambia esto por la contraseña real

    if($_POST["username"] === $username && $_POST["password"] === $password){
        // Las credenciales son válidas, iniciar sesión
        $_SESSION['logged_in'] = true;
        
        // Redirigir al usuario a la página de bienvenida
        header("Location: welcome.php");
        exit;
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        $login_error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <?php if(isset($login_error)): ?>
        <p><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>

<?php
session_start();
include("php/connection.php");
include("php/functions.php");

$options = ''; // Initialize an empty string to store the options

$query = "SELECT * FROM user_packagedata";
$result = mysqli_query($conexion, $query);

if (!$result) {
    // Handle query error
    die("Query failed: " . mysqli_error($conexion));
}

// Fetch all rows into an array
$rooms_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rooms_data[] = $row;
    // Append each option to the $options string
    $options .= "<option value='{$row['pak_id']}'>{$row['pak_name']}</option>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['modificacion'])) {
    $id = $_POST['combobox'];
    $pak_name = $_POST['pak_name'];
    $pak_price = $_POST['pak_price'];
    $pak_description = $_POST['pak_description'];
    $pak_city = $_POST['pak_city'];

    $query = "UPDATE `user_packagedata` SET `pak_name`='$pak_name',`pak_price`='$pak_price',`pak_description`='$pak_description',`pak_city`='$pak_city' WHERE `pak_id` = '$id'";
    $result = mysqli_query($conexion,$query);

    echo("modificacion correcta");

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

    <h2 class="crud_header">Modificacion de paquetes</h2>
    <br><br>
    <form method="post" class="admin_altas">
        <div class="delete_container">
            <select id="combobox" name="combobox">
                <option>-- Selecciona un paquete --</option>
                <?php echo $options; ?>
            </select>
        </div>
        <br><br>
        <div>
            <div class="correo_login">
                <input type="text" id="pak_name" name="pak_name">
                <label>Nombre del paquete</label>
            </div>
            <div class="correo_login">
                <input type="number" id="pak_price" name="pak_price">
                <label>Precio del paquete</label>
            </div>
            <div class="correo_login">
                <input type="text" id="pak_description" name="pak_description">
                <label>Descripcion del paquete</label>
            </div>
            <div class="correo_login">
                <input type="text" id="pak_city" name="pak_city">
                <label>Ciudad</label>
            </div>
            <div class="buton_login">
                <input type="submit" value="Modificar" name="modificacion">
            </div>
        </div>
    </form>

    <script>
        // Get reference to the select element
        const combobox = document.getElementById('combobox');
        
        // PHP array containing room data
        const rooms_data = <?php echo json_encode($rooms_data); ?>;
        
        // Add event listener to the combobox
        combobox.addEventListener('change', function() {
            // Get the selected value (pak_id)
            const selectedValue = parseInt(this.value);
            
            // Find room data corresponding to selected pak_id
            const selectedRoom = rooms_data.find(room => parseInt(room.pak_id, 10) === selectedValue);


            // If room data found, fill input fields
            if (selectedRoom) {
                document.getElementById('pak_name').value = selectedRoom.pak_name;
                document.getElementById('pak_price').value = selectedRoom.pak_price;
                document.getElementById('pak_description').value = selectedRoom.pak_description;
                document.getElementById('pak_city').value = selectedRoom.pak_city;
            } else {
                // Clear input fields if no room data found
                document.getElementById('pak_name').value = '';
                document.getElementById('pak_price').value = '';
                document.getElementById('pak_description').value = '';
                document.getElementById('pak_city').value = '';
            }
        });
    </script>

</body>
</html>

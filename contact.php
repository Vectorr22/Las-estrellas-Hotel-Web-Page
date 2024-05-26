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


$rooms_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rooms_data[] = $row;
    $options .= "<option value='{$row['pak_id']}'>{$row['pak_name']}</option>";
}


$user_data = check_login($conexion);
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['reservar'])) {
  $noHabitaciones = $_POST['habitaciones'];
  $tipo_Habitacion = $_POST['tipo_habitacion'];
  $numPersonas = $_POST['numPersonas'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];
  $id = $user_data['id'];


  $reservationData = [
    'noHabitaciones' => $noHabitaciones,
    'tipo_Habitacion' => $tipo_Habitacion,
    'numPersonas' => $numPersonas,
    'check_in' => $check_in,
    'check_out' => $check_out,
    'id' => $id
  ];

  $_SESSION['reservation'] = $reservationData;


  $query = "INSERT INTO `user_reservation`(`reservation_numRooms`, `reservation_typeRoom`, 
  `reservation_numPeople`, `reservation_checkIn`, `reservation_checkOut`, `user_id`) 
  VALUES ('$noHabitaciones','$tipo_Habitacion','$numPersonas','$check_in','$check_out','$id')";

  header("Location: php/generarPDF.php");
  die;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/mobile.css">
  <link rel="stylesheet" media="screen and (max-width:768px)" href="style/mobile.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" media="screen and (max-width:768px)" href="css/mobile.css">
  <title>Hotel Las Estrellas</title>
</head>

<body>
  <header>
    <nav id="navbar">
      <nav id="navbar" class="py-30">
        <div class="container">
          <h1 class="logo"><a href="index.php">Hotel Las Estrellas</a></h1>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">Acerca de</a></li>
            <li><a href="php/logout.php">Logout</a></li>
            <!-- <li><a href="contact.php" class="current">Booking</a></li> -->
          </ul>
        </div>
      </nav>
  </header>

  <hr>

  <div class="bk-line"></div>


  <section id="contact-form" class="py-3">
    <section id="contact" class="py-80">
      <div class="container">
        <h1>Bienvenido <?php echo $user_data['user_name']; ?></h1>
        <h2>Reservación</h2>
        <br><br>
        <form method="post">
          <!-- <div class="form-group">
          <label for="name">Nombre Completo</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <input type="email" id="email" name="email" required>
        </div> -->
          <div class="form-group">
            <label for="rooms">Número de Habitaciones</label>
            <input type="number" id="rooms" name="habitaciones" min="1" required>
          </div>
          <div class="form-group">
            <label for="room-type">Tipo de Habitación</label>
            <select id="room-type" name="tipo_habitacion" required>
                <option>-- Selecciona un paquete --</option>
                <?php echo $options; ?>
            </select>
          </div><br>
          <div class="form-group">
            <label for="guests">Cantidad de Personas</label>
            <input type="number" id="guests" name="numPersonas" min="1" required>
          </div>
          <div class="form-group">
            <label for="check-in-date">Fecha de Entrada</label>
            <input type="date" id="check-in-date" name="check_in" required>
          </div>
          <div class="form-group">
            <label for="check-out-date">Fecha de Salida</label>
            <input type="date" id="check-out-date" name="check_out" required>
          </div>

          <button type="submit" class="btn btn-light" name="reservar">Reservar</button>
        </form>
      </div>
    </section>

    <section class="contact-features">
      <div class="box bg-contact-1">
        <h3>Double Room</h3>
        <p>Una opción ideal para parejas o amigos que viajan juntos. Ofrece dos camas dobles o una cama king-size y comodidades modernas para una estancia confortable.</p>
      </div>
      <div class="box location">
        <h4>Location</h4>
        <p>25 Street Zakym Greece</p>
      </div>
      <div class="box bg-contact-2">
        <h3>Deluxe Room</h3>
        <p>Sumérgete en el lujo con nuestra habitación deluxe. Decorada con elegancia y equipada con comodidades de alta gama para una experiencia de hospedaje excepcional.</p>
      </div>
      <div class="box phone">
        <h4>Phone number</h4>
        <p>333 444 6666</p>
      </div>
      <div class="box bg-contact-3">
        <h3>Honeymoon Room</h3>
        <p>Celebra el amor en nuestra romántica habitación de luna de miel. Perfecta para parejas, ofrece un ambiente íntimo y detalles especiales para una estancia inolvidable.</p>
      </div>
      <div class="box email">
        <h4>Email Address</h4>
        <p>hola@mail.com</p>
      </div>
    </section>


    <div class="clr"></div>
    <br>
    <section id="footer">

      <p>Hotel Las Estrellas &copy; 2024, All Rights Reserved </p>
    </section>

    <footer id="mainfooter" class="py-30">
      <p>&copy; 2024 Hotel Las Estrellas</p>
    </footer>

</body>

</html>
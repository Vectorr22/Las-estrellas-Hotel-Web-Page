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
  $room_id = $_POST['tipo_habitacion'];
  $query = "SELECT pak_name from user_packagedata WHERE pak_id = $room_id";
  $result = mysqli_query($conexion, $query);
  $tipo_Habitacion = mysqli_fetch_assoc($result);
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
    'id' => $id,
    'room_id' => $room_id
  ];

  $prices = get_prices($reservationData);

  $_SESSION['reservation'] = $reservationData;
  $_SESSION['totalPrice'] = $prices['total'];
  $query = "INSERT INTO `user_reservation`(`reservation_numRooms`, `reservation_numPeople`, `reservation_checkIn`, `reservation_checkOut`, `user_id`, `reservation_package_id`) VALUES ('$noHabitaciones','$numPersonas','$check_in','$check_out','$id','$room_id')";
  $result = mysqli_query($conexion, $query);
  if($result)
  {
    header("Location: payment.php");
    die;
  }
  else
  {
    echo "Error: " . mysqli_error($conexion);
  }
  
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
  <script type="text/javascript">
    function validate() {
        let rooms = document.getElementById("rooms");
        let guests = document.getElementById("guests");
        let checkInDate = document.getElementById("check-in-date");
        let checkOutDate = document.getElementById("check-out-date");
        let errorMessage = document.getElementById("error-message");
        
        let today = new Date().toISOString().split("T")[0];
        let twoYearsFromToday = new Date();
        twoYearsFromToday.setFullYear(twoYearsFromToday.getFullYear() + 2);
        twoYearsFromToday = twoYearsFromToday.toISOString().split("T")[0];

        errorMessage.textContent = "";

        // Validate rooms
        if (!/^[1-3]$/.test(rooms.value)) {
            rooms.style.border = "red solid 3px";
            errorMessage.textContent = "Número de habitaciones debe ser entre 1 y 3.";
            return false;
        } else {
            rooms.style.border = "";
        }

        // Validate guests
        if (!/^[1-9]$|^10$/.test(guests.value)) {
            guests.style.border = "red solid 3px";
            errorMessage.textContent = "Cantidad de personas debe ser entre 1 y 10.";
            return false;
        } else {
            guests.style.border = "";
        }

        // Validate check-in date
        if (checkInDate.value < today || checkInDate.value > twoYearsFromToday) {
            checkInDate.style.border = "red solid 3px";
            errorMessage.textContent = "Fecha de entrada debe ser a partir de hoy y no más de dos años en el futuro.";
            return false;
        } else {
            checkInDate.style.border = "";
        }

        // Validate check-out date
        if (checkOutDate.value <= checkInDate.value || checkOutDate.value > twoYearsFromToday) {
            checkOutDate.style.border = "red solid 3px";
            errorMessage.textContent = "Fecha de salida debe ser después de la fecha de entrada y no más de dos años en el futuro.";
            return false;
        } else {
            checkOutDate.style.border = "";
        }

        return true;
    }

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        var interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(interval);
                alert("Tiempo de reserva expirado. Serás redirigido a la página principal.");
                window.location.href = 'index.php';
            }
        }, 1000);
    }

    window.onload = function () {
        var tenMinutes = 60 * 10,
            display = document.querySelector('#time');
        startTimer(tenMinutes, display);
    };
  </script>
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
        <br>
        <div>Tiempo restante: <span id="time">10:00</span></div>
        <br><br>
        <form method="post" onsubmit="return validate();">
          <div class="form-group">
            <label for="rooms">Número de Habitaciones</label>
            <input type="number" id="rooms" name="habitaciones" min="1" max="3" required>
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
            <input type="number" id="guests" name="numPersonas" min="1" max="10" required>
          </div>
          <div class="form-group">
            <label for="check-in-date">Fecha de Entrada</label>
            <input type="date" id="check-in-date" name="check_in" required>
          </div>
          <div class="form-group">
            <label for="check-out-date">Fecha de Salida</label>
            <input type="date" id="check-out-date" name="check_out" required>
          </div>

          <div id="error-message" style="color: red; margin-bottom: 10px;"></div>

          <button type="submit" class="btn btn-light" name="reservar">Reservar</button>
        </form>
        <br>
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
    <section id="footer" class="footer_">

      <p>Hotel Las Estrellas &copy; 2024, All Rights Reserved </p>
    </section>

    <footer id="mainfooter" class="py-30">
      <p>&copy; 2024 Hotel Las Estrellas</p>
    </footer>

    


</body>

</html>

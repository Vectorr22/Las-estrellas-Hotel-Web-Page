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
  $query = "SELECT pak_name FROM user_packagedata WHERE pak_id = $room_id";
  $result = mysqli_query($conexion, $query);

  if (!$result) {
    // Handle query error
    die("Query failed: " . mysqli_error($conexion));
  }

  $tipo_Habitacion = mysqli_fetch_assoc($result);
  $numPersonas = $_POST['numPersonas'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];
  $id = $user_data['id'];

  $query = "
    SELECT SUM(reservation_numRooms) as reserved_rooms 
    FROM user_reservation 
    WHERE reservation_package_id = $room_id 
    AND (
      (reservation_checkIn <= '$check_in' AND reservation_checkOut > '$check_in')
      OR (reservation_checkIn < '$check_out' AND reservation_checkOut >= '$check_out')
      OR ('$check_in' <= reservation_checkIn AND '$check_out' > reservation_checkIn)
      OR ('$check_in' < reservation_checkOut AND '$check_out' >= reservation_checkOut)
    )
  ";

  $result = mysqli_query($conexion, $query);

  if (!$result) {
    die("Query failed: " . mysqli_error($conexion));
  }

  if (is_null($result)) {
    $reserved_rooms = 0;
  } else {
    $reserved_rooms = mysqli_fetch_assoc($result)['reserved_rooms'];
  }
  // Obtener disponibilidad de habitaciones
  $query = "SELECT pak_disponibilidad FROM user_packagedata WHERE pak_id = $room_id";
  $result = mysqli_query($conexion, $query);

  if (!$result) {
    die("Query failed: " . mysqli_error($conexion));
  }

  $total_rooms = mysqli_fetch_assoc($result)['pak_disponibilidad'];
  $available_rooms = $total_rooms - $reserved_rooms;

  $reservationData = [
    'noHabitaciones' => $noHabitaciones,
    'tipo_Habitacion' => $tipo_Habitacion['pak_name'],
    'numPersonas' => $numPersonas,
    'check_in' => $check_in,
    'check_out' => $check_out,
    'id' => $id,
    'room_id' => $room_id
  ];

  $prices = get_prices($reservationData);
  $_SESSION['reservation'] = $reservationData;
  $_SESSION['totalPrice'] = $prices['total'];

  if ($available_rooms >= $noHabitaciones) {
    // Proceder con la reserva
    $query = "INSERT INTO user_reservation (user_id, reservation_package_id, reservation_checkIn, reservation_checkOut, reservation_numRooms, reservation_numPeople) VALUES ('$id', '$room_id', '$check_in', '$check_out', '$noHabitaciones', '$numPersonas')";
    $result = mysqli_query($conexion, $query);

    if ($result) {
      // Redirigir a la página de pago
      $_SESSION['reservation']['reservation_id'] = mysqli_insert_id($conexion); // Almacena el ID de la reserva
      header("Location: payment.php");
      die;
    } else {
      echo "Error: " . mysqli_error($conexion) . "<br>";
    }
  } else {
    $error_message = "No hay suficientes habitaciones disponibles para las fechas seleccionadas.";
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
  <link rel="stylesheet" media="screen and (max-width:768px)" href="css/mobile.css">
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
      var timer = duration,
        minutes, seconds;
      var interval = setInterval(function() {
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

    window.onload = function() {
      var tenMinutes = 60 * 10,
        display = document.querySelector('#time');
      startTimer(tenMinutes, display);
    };

    function calculatePrice() {
      const packagePrices = {
        1: 120, // Example price for package ID 1 (Sencilla)
        2: 70, // Example price for package ID 2 (Doble)
        3: 250, // Example price for package ID 3 (Deluxe)
        4: 240 // Example price for package ID 4 (Luna de Miel)
      };

      let roomType = parseInt(document.getElementById('room-type').value);
      let numRooms = parseInt(document.getElementById('rooms').value);
      let checkInDate = new Date(document.getElementById('check-in-date').value);
      let checkOutDate = new Date(document.getElementById('check-out-date').value);

      let estimatedPrice = 0;

      if (!isNaN(roomType) && !isNaN(numRooms) && !isNaN(checkInDate.getTime()) && !isNaN(checkOutDate.getTime())) {
        let nightPrice = packagePrices[roomType] || 0;
        let timeDiff = checkOutDate.getTime() - checkInDate.getTime();
        let nights = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert milliseconds to days

        let costPerRoom = nightPrice * numRooms;
        let subtotal = costPerRoom * nights;
        let iva = subtotal * 0.16;
        let total = subtotal + iva;

        estimatedPrice = total;
      }

      document.getElementById('estimated-price').textContent = "Precio estimado: $" + estimatedPrice.toFixed(2);
    }
  </script>
</head>

<body>
  <header>
    <nav id="navbar">
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
        <div>Tiempo restante: <span id="time">10:00</span></div>
        <div id="estimated-price" style="color: green; margin-top: 10px; text-align: right;">Precio estimado: $0</div>
        <br><br>
        <form method="post" onsubmit="return validate();">
          <div class="form-group">
            <label for="room-type">Tipo de Habitación</label>
            <select id="room-type" name="tipo_habitacion" required onchange="calculatePrice()">
              <option value="">-- Selecciona un paquete --</option>
              <?php echo $options; ?>
            </select>
          </div><br>

          <div class="form-group">
            <label for="rooms">Número de Habitaciones</label>
            <input type="number" id="rooms" name="habitaciones" min="1" max="3" required oninput="calculatePrice()">
          </div>

          <div class="form-group">
            <label for="guests">Cantidad de Personas</label>
            <input type="number" id="guests" name="numPersonas" min="1" max="10" required>
          </div>
          <div class="form-group">
            <label for="check-in-date">Fecha de Entrada</label>
            <input type="date" id="check-in-date" name="check_in" required onchange="calculatePrice()">
          </div>
          <div class="form-group">
            <label for="check-out-date">Fecha de Salida</label>
            <input type="date" id="check-out-date" name="check_out" required onchange="calculatePrice()">
          </div>

          <div id="error-message" style="color: red; margin-bottom: 10px;"></div>

          <button type="submit" class="btn btn-light" name="reservar">Reservar</button>
        </form>
        <br>
        <div id="error-message" style="color: red; margin-bottom: 10px;">
          <?php if (!empty($error_message)) echo $error_message; ?>
        </div>
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
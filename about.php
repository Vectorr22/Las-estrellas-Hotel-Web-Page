<?php
session_start();
$_SESSION;
include('php/connection.php');
if (isset($_SESSION['user_type'])) {
  $userType = $_SESSION['user_type'];
} else
  $userType = 'guest';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" media="screen and (max-width:768px)" href="css/mobile.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" media="screen and (max-width:768px)" href="css/mobile.css">
  <title>Hotel Las Estrellas | Acerca de</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBJc6pEb4ZZ3uNfyTOr8kd7SNER7TrsNg&callback=initMap" async defer></script>
  <script>
    function initMap() {
      // The location of the hotel
      var hotelLocation = {
        lat: 25.276987,
        lng: 55.296249
      }; // Example coordinates, replace with the actual coordinates
      // The map, centered at the hotel
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: hotelLocation
      });
      // The marker, positioned at the hotel
      var marker = new google.maps.Marker({
        position: hotelLocation,
        map: map
      });
    }
  </script>
  <style>
    .about-text {
      font-family: 'Roboto', sans-serif;
      font-size: 18px;
      line-height: 1.6;
      color: #ffffff;
      /* background-color: #ff8c42; */
      padding: 20px;
      border-radius: 10px;
    }

    .about-text h1 {
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .about-text p {
      margin-bottom: 15px;
    }

    .about-img img {
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <header>
    <nav id="navbar" class="py-30">
      <div class="container">
        <h1 class="logo"><a href="index.php">Hotel las Estrellas</a></h1>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php" class="current">Acerca de</a></li>
          <?php if ($userType == 'admin') : ?>
            <li><a href="adminCRUD.php">Modificaciones</a></li>
          <?php else : ?>
            <li><a href="contact.php">Reservar</a></li>
          <?php endif; ?>

          <?php if ($userType == 'guest') : ?>
            <li><a href="login.php"><img src="img/loginIcon.png" class="login_Icon"></a></li>
          <?php else : ?>
            <li><a href="php/logout.php">Logout</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>

  <section id="about" class="light">
    <section id="about" class="py-50">
      <div class="container">
        <div class="about-text">
          <div class="about-content">
            <h1>Acerca de nosotros</h1>
            <p>At Hotel Las Estrellas, we pride ourselves on providing an exceptional experience for our guests. Nestled in a serene location, our hotel offers a perfect blend of luxury and comfort. Each room is meticulously designed to ensure a relaxing stay, with modern amenities and elegant decor. Our dedicated staff is committed to delivering personalized service to meet all your needs. Whether you're here for a romantic getaway, a family vacation, or a business trip, Hotel Las Estrellas is the ideal destination. Enjoy our world-class facilities, including a stunning pool, fine dining restaurant, and state-of-the-art fitness center. We look forward to welcoming you and making your stay unforgettable.</p>
          </div>
          <div class="about-img">
            <img src="img/about.jpg" alt="">
          </div>
        </div>

        <!-- Add the map container -->
        <div id="map" style="height: 400px; width: 100%; margin-top: 20px;"></div>
    </section>

    <section id="testimonials">
      <section id="testimonial" class="py-80">
        <div class="container">
          <h2 style="font-size: 40px; background-color:rgba(0, 0, 0, 0.3); margin-bottom: 15px;">Lo que nuestros clientes dicen de nosotros</h2>
          <div class="testimonial">
            <p style="font-size: 20px; background-color:rgba(0, 0, 0, 0.3); margin-bottom: 5px;">"Una experiencia inolvidable"
              Me hospedé en el Hotel Las Estrellas para celebrar nuestro aniversario y fue simplemente perfecto. El personal fue extremadamente atento y la habitación estaba impecable. ¡Volveremos sin duda alguna!
              — Laura G.</p>
          </div>
          <div class="testimonial">
            <p style="font-size: 20px; background-color:rgba(0, 0, 0, 0.3); margin-bottom: 5px;">"El mejor lugar para relajarse"
              La estancia en el Hotel Las Estrellas superó nuestras expectativas. Las instalaciones son de primera clase y el ambiente es muy tranquilo. Disfrutamos mucho de la piscina y del spa. ¡Altamente recomendado!
              — Carlos M.</p>
          </div>
          <div class="testimonial">
            <p style="font-size: 20px; background-color:rgba(0, 0, 0, 0.3); margin-bottom: 5px;">"Volveremos pronto"
              Pasamos unas vacaciones fantásticas en el Hotel Las Estrellas. La ubicación es perfecta y el personal siempre está dispuesto a ayudar. Nos encantó el desayuno buffet, muy variado y delicioso.
              — Patricia S.</p>
          </div>
        </div>
      </section>
    </section>

    <div class="clr"></div>

    <section id="footer">
      <p>Hotel Las Estrellas &copy; 2024, All Rights Reserved </p>
    </section>

    <footer id="mainfooter" class="py-30">
      <p>&copy; 2024 Hotel Las Estrellas</p>
    </footer>

</body>

</html>
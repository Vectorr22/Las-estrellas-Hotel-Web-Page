<?php
  session_start();
  $_SESSION;
  include('php/connection.php');
  if(isset($_SESSION['user_type']))
  {
    $userType = $_SESSION['user_type'];
  }
  else
    $userType = 'guest';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>Hotel las Estrellas | Welcome</title>
</head>

<body>
  <header>
    <nav id="navbar" class="py-30">
      <div class="container">
        <h1 class="logo"><a href="index.php">Hotel las Estrellas</a></h1>
        <ul>
          <li><a href="index.php" class="current">Home</a></li>
          <li><a href="about.php">Acerca de</a></li>
          <?php if ($userType== 'admin') : ?>
            <li><a href="adminCRUD.php">Modificaciones</a></li>
          <?php else: ?>
            <li><a href="contact.php">Reservar</a></li>
          <?php endif; ?>

          <?php if ($userType == 'guest'): ?>
            <li><a href="login.php"><img src="img/loginIcon.png" class="login_Icon"></a></li>
          <?php else: ?>
            <li><a href="php/logout.php">Logout</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>

  <container>
    <div id="showcase" class="showcase-content">
      <div class="bloor_bg">
        <h1 class="upImage">Bienvenido al hotel de las estrellas</h1>
        <p class="upImage">¡Descubre el epitome del lujo en Las Estrellas Hotel & Spa! Sumérgete en la elegancia y el
          confort en nuestro exclusivo refugio. Desde majestuosas suites hasta un spa de clase mundial, cada momento
          en Las Estrellas es sinónimo de sofisticación. Explora nuestros paquetes de viaje y vive una experiencia
          inolvidable de lujo y distinción. ¡Bienvenido a tu escapada de ensueño!>
          <br>
          <a class="btn btn-light" href="about.php">Como funciona</a>
      </div>
    </div>
  </container>

  <div id="showcase" class="py-80">
    <div class="container bloor_bg">
      <h2>Las mejores experiencias con nosotros</h2>
      <p class="large">Explora nuestros exclusivos paquetes de viaje y déjate llevar por la indulgencia y el lujo en
        Luxe
        Royale Hotel & Spa. Desde escapadas románticas hasta retiros de bienestar, nuestros paquetes están diseñados
        para
        satisfacer todos tus deseos y necesidades. Sumérgete en una experiencia inolvidable donde el confort y la
        elegancia se
        encuentran en perfecta armonía.</p>
      <a href="about.php" class="btn btn-light">Acerca de</a>
    </div>
  </div>


  <style>
  .custom-slider {
    width: 70%;
    height: 600px;
    margin: 50px auto;
    box-shadow: 0px 0px 10px 3px grey;
    position: relative;
    overflow: hidden;
    border: 5px solid #3949ab;
  }

  .custom-slider-figure {
    position: relative;
    width: 500%;
    margin: 0;
    left: 0;
    transition: 1s ease-in-out;
    display: flex;
  }

  .custom-slide {
    width: 20%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    flex-direction: column;
  }

  .custom-slide img {
    width: 100%;
    height: 100%;
  }

  .custom-text-overlay {
    position: absolute;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
  }

  .custom-title {
    font-size: 36px;
    font-weight: bold;
    background: rgba(0, 0, 0, 0.7);
    padding: 10px;
  }

  .custom-plain-text {
    font-size: 24px;
    background: rgba(0, 0, 0, 0.5);
    padding: 10px;
    margin-top: 10px;
  }

  .custom-btn-next, .custom-btn-prev {
    position: absolute;
    top: 45%;
    cursor: pointer;
    color: white;
    background: #3949ab;
    padding: 20px;
    font-size: 50px;
    border: none;
  }

  .custom-btn-prev {
    left: 0px;
  }

  .custom-btn-next {
    right: 0px;
  }
</style>
</head>
<body>

<div class="custom-slider">
  <figure class="custom-slider-figure">
    <div class="custom-slide">
      <img src="img/feature-1.jpg">
      <div class="custom-text-overlay">
        <div class="custom-title">Habitacion Doble</div>
        <div class="custom-plain-text">Una opción ideal para parejas o amigos que viajan juntos. Ofrece dos camas dobles o una cama king-size y
          comodidades modernas para una estancia confortable.</div>
      </div>
    </div>
    <div class="custom-slide">
      <img src="img/feature-2.jpg">
      <div class="custom-text-overlay">
        <div class="custom-title">Habitacion Deluxe</div>
        <div class="custom-plain-text">Sumérgete en el lujo con nuestra habitación deluxe. Decorada con elegancia y equipada con comodidades de alta
          gama para una experiencia de hospedaje excepcional.</div>
      </div>
    </div>
    <div class="custom-slide">
      <img src="img/feature-3.jpg">
      <div class="custom-text-overlay">
        <div class="custom-title">Habitacion Luna de Miel</div>
        <div class="custom-plain-text">Celebra el amor en nuestra romántica habitación de luna de miel. Perfecta para parejas, ofrece un ambiente
          íntimo y detalles especiales para una estancia inolvidable.</div>
      </div>
    </div>
  </figure>

  <button class="custom-btn-prev"><i class="fa fa-arrow-circle-left"></i></button>
  <button class="custom-btn-next"><i class="fa fa-arrow-circle-right"></i></button>
</div>

<script>
$(document).ready(function() {
  var x = 0;
  var slideCount = $('.custom-slide').length;

  // For next slide
  $('.custom-btn-next').click(function() {
    x = (x <= (slideCount - 2) * 100) ? (x + 100) : 0;
    $('.custom-slider-figure').css('left', -x + '%');
  });

  // For prev slide
  $('.custom-btn-prev').click(function() {
    x = (x >= 100) ? (x - 100) : (slideCount - 1) * 100;
    $('.custom-slider-figure').css('left', -x + '%');
  });
});
</script>


  
  <section id="reservation" class="py-30">
    <div class="container">
      <div class="reservation-text">
        <h2>Haz tu reservación ahora mismo!</h2>
        <a href="contact.php" class="btn btn-light">Reservar</a>
      </div>
  </section>


  <div class="clr"></div>

  <br>
  <section id="footer" class="footer_">
    <p>Hotel Las Estrellas &copy; 2024, All Rights Reserved </p>
  </section>

  <footer id="mainfooter" class="py-30">
    <p>&copy; 2024 Las Estrellas</p>
  </footer>

</body>

</html>
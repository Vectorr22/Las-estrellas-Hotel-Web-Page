<?php
  session_start();
  $_SESSION;
  include('php/connection.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <title>Hotel las Estrellas | Welcome</title>
</head>

<body>
  <header>
    <nav id="navbar" class="py-30">
      <div class="container">
        <h1 class="logo"><a href="index.html">Hotel las Estrellas</a></h1>
        <ul>
          <li><a href="index.php" class="current">Home</a></li>
          <li><a href="about.php">Acerca de</a></li>
          <li><a href="contact.php">Reservar</a></li>
          <li><a href="login.php"><img src = "img/loginIcon.png" class="login_Icon"></a></li>
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
          <a class="btn btn-light" href="#informacion.html">Como funciona</a>
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
      <a href="about.html" class="btn btn-light">Acerca de</a>
    </div>
  </div>


  <section id="reservation" class="py-30">
    <div class="container">
      <div class="reservation-text">
        <h2>Haz tu reservación ahora mismo!</h2>
        <a href="contact.html" class="btn btn-light">Reservar</a>
      </div>
  </section>

  <section id="features">
    <div class="box features-1">
      <div class="mini_bg">
        <h4>Habitación Doble</h4>
        <p>Una opción ideal para parejas o amigos que viajan juntos. Ofrece dos camas dobles o una cama king-size y
          comodidades modernas para una estancia confortable.</p>
      </div>
    </div>

    <div class="box features-2">
      <div class="mini_bg">
        <h4>Habitación Deluxe</h4>
        <p>Sumérgete en el lujo con nuestra habitación deluxe. Decorada con elegancia y equipada con comodidades de alta
          gama para una experiencia de hospedaje excepcional.</p>
      </div>
    </div>

    <div class="box features-3">
      <div class="mini_bg">
        <h4>Luna de miel</h4>
        <p>Celebra el amor en nuestra romántica habitación de luna de miel. Perfecta para parejas, ofrece un ambiente
          íntimo y detalles especiales para una estancia inolvidable.</p>
      </div>
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
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
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" media="screen and (max-width:768px)" href="style/mobile.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" media="screen and (max-width:768px)" href="css/mobile.css">
  <title>Hotel Las Estrellas | Acerca de</title>
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
            <h1>Aceca de nosotros</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non doloribus rerum dolor maiores provident, perferendis in, ea deserunt placeat dignissimos, fugiat aliquid! Pariatur, magnam. Illum laudantium in veritatis unde assumenda nemo iure ex et error. Tempora voluptatum hic dolorum non voluptatibus repudiandae pariatur porro doloribus eveniet. Alias recusandae quis aliquam.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti debitis praesentium dolores reiciendis quas sed ratione voluptatibus assumenda quibusdam harum.</p>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Totam eveniet at explicabo repellat reprehenderit, laboriosam voluptatem nemo voluptatibus neque? Omnis illo minus facere corporis laborum itaque earum hic assumenda, suscipit nihil veniam rem pariatur, eos in quidem reprehenderit ea vitae non. Recusandae provident nihil eos facilis beatae placeat quis molestiae.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores mollitia aspernatur quae odit illum, iusto maxime debitis dolorem doloremque commodi.</p>
          </div>
          <div class="about-img">
            <img src="../img/about.jpg" alt="">
            <img src="img/about.jpg" alt="">
          </div>
        </div>
    </section>

    <section id="testimonials">
      <section id="testimonial" class="py-80">
        <div class="container">
          <h2>What Our Guests Say</h2>
          <div class="testimonial">
            <img src="../img/testimonial-1.jpg" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum ipsum impedit modi accusamus. Saepe placeat sunt vitae. Sunt, esse inventore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, id!</p>
            <h2>What our guest say</h2>
            <div class="testimonial-content">
              <img src="img/testimonial-1.jpg" alt="">
              <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur deleniti nisi, non saepe eaque vel sed labore in fugiat ipsa obcaecati reprehenderit debitis itaque cumque harum consequatur ipsam veniam quaerat!</p>
            </div>
            <div class="testimonial">
              <img src="../img/testimonial-2.jpg" alt="">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum ipsum impedit modi accusamus. Saepe placeat sunt vitae. Sunt, esse inventore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, fugit.</p>
              <div class="testimonial-content">
                <img src="img/testimonial-2.jpg" alt="">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur deleniti nisi, non saepe eaque vel sed labore in fugiat ipsa obcaecati reprehenderit debitis itaque cumque harum consequatur ipsam veniam quaerat!</p>
              </div>
            </div>
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
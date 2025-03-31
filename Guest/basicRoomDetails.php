<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Room Details</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../Assets/Template/Student/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Assets/Template/Student/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../Assets/Template/Student/vendor/aos/aos.css" rel="stylesheet">
  <link href="../Assets/Template/Student/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../Assets/Template/Student/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../Assets/Template/Student/css/main.css" rel="stylesheet">

	<link rel="shortcut icon" href="../Assets/Template/Warden/images/Logo.png" />

  <style>
    input[type=submit],[type=reset],a.button {
      color: var(--contrast-color);
      background: var(--accent-color);
      border: 0;
      padding: 10px 30px;
      transition: 0.4s;
      border-radius: 50px;
    }

  </style>

</head>

<body class="index-page">

 <?php
 include("header.php");
 include("../Assets/Connection/Connection.php");

 ?>

  <main class="main">

       <!-- Services Section -->
       <section id="services" class="services section light-background">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">

  <h2>Rooms</h2>
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4">

    <?php
      include("../Assets/Connection/Connection.php");

      $sel="select * from tbl_roomtype";
      $row=$con->query($sel);
      $i=1;
      while($data=$row->fetch_assoc()){
        ?>
          <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i ><?php echo $i;  ?></i>
              </div>
              <a href="" class="stretched-link">
              <h3><?php echo $data["room_share"]." Share" ?></h3>
              <h3><?php 
              if($data["room_type"]==1){
                echo "AC";
              }
              if($data["room_type"]==2){
                echo "Non AC";
              } ?></h3>
                <h3><?php echo $data["room_amount"]." Rs." ?></h3>
              </a>
              <p>✔️ High-speed Wi-Fi</p>
              <p>✔️ Air Conditioning / Fan</p>
              <p>✔️ Attached or Shared Bathroom</p>
            </div>
          </div><!-- End Service Item -->
        <?php
        $i+=1;
      }
        ?>

</div>
<br><br><br>
<center>
<a class="button" href="viewRoomDetails.php">View Rooms</a>
</center>

</section><!-- /Services Section -->
  </main>
    <br><br><br><br>
<?php
 include("footer.php");
 ?>

</body>

</html>


</body>
</html>

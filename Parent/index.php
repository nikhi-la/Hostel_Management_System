<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>HMS</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
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

  <!-- =======================================================
  * Template Name: eNno
  * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

<?php
include("SessionValidator.php");
  if(!isset($_SESSION["user_id"]))
  {
    ?>
      <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="../Assets/Student/img/Logo.png" alt=""> 
        <h1 class="sitename">HMS</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" >Home</a></li>
          <li class="dropdown"><a href="#"><span>Rooms</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="../Guest/basicRoomDetails.php">Room Shares</a></li>
              <li><a href="../Guest/viewRoomDetails.php">View Rooms</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="btn-getstarted" style="width:100px;"><span>Register</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="../Guest/newStudent.php">Student</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      
      <a class="btn-getstarted" href="../Login.php">Login</a>

    </div>
  </header>
    <?php
  }
  else{
    ?>
      <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="../Assets/Student/img/Logo.png" alt="">
        <h1 class="sitename">HMS</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" >Home</a></li>
          <li><a href="viewAllocatedRoom.php">View Room Preference</a></li>
          <li><a href="viewAttendance.php">Attendance</a></li>
          <li><a href="viewMovementLog.php">Movement Log</a></li>
          <li><a href="viewLeaveRequest.php">Leaves</a></li>
          
          <li class="dropdown"><a href="#"><span>Fees</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="billSummary.php">For This Month</a></li>
              <li><a href="viewPreviousBills.php">Previous Bills</a></li>
            </ul>
          </li>
          <li><a href="complaint.php">Complaint</a></li>
          <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="myProfile.php">My Profile</a></li>
              <li><a href="changePassword.php">Change Password</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="../Logout.php">Logout</a>

    </div>
  </header>
    <?php
  }
?>
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
            <h1>Home Away From Home</h1>
            <p>We are team of talented designers making websites with Bootstrap</p>
            <div class="d-flex">
              <a href="Login.php" class="btn-get-started">Login</a>
              
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="../Assets/Template/Student/img/hostel.jpg" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-activity icon"></i></div>
              <h4><div class="stretched-link">You're assured of a safe and friendly stay, quality food and neat premises at a very prime location.
</div></h4>
              </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
              <h4><a href="" class="stretched-link">Our hostel seeks to provide a residence with the pleasant home atmosphere for inmates.</a></h4>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
              <h4><a href="" class="stretched-link justify-content">We want your experience to be excellent.Ideal for who are looking for a comfortable and secure place to stay with a very Homely Atmosphere.</a></h4>
              
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <section id="portfolio" class="portfolio section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Gallery</h2>
 
</div><!-- End Section Title -->

<div class="container">

  <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
        <img src="Assets/Template/Student/img/build.jpg" class="img-fluid" alt="">
        
      </div><!-- End Portfolio Item -->

      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
        <img src="Assets/Template/Student/img/index1.jpg" class="img-fluid" alt="">
        
      </div><!-- End Portfolio Item -->

      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
        <img src="Assets/Template/Student/img/roomimg.jpg" style="width:110%" class="img-fluid" alt="">
        
      </div><!-- End Portfolio Item -->

      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
        <img src="Assets/Template/Student/img/studyroom.jpg" class="img-fluid" alt="">
        
      </div><!-- End Portfolio Item -->

      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
        <img src="Assets/Template/Student/img/students.jpg" style="width:110%" class="img-fluid" alt="">
        
      </div><!-- End Portfolio Item -->

      <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
        <img src="Assets/Template/Student/img/toilet.jpg" class="img-fluid" alt="">
        
      </div><!-- End Portfolio Item -->

    </div><!-- End Portfolio Container -->

  </div>

</div>

</section><!-- /Portfolio Section -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Specialities</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
            
              <a href="" class="stretched-link">
                <h3>Homely Food</h3>
              </a>
              <p>We serve homely food prepared by our staffs and also we can provide vegetarian and Non-vegetarian food on firm demand at reasonable rate.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <a href="" class="stretched-link">
                <h3>Free Wi-Fi</h3>
              </a>
              <p>Enjoy the high speed and unlimited internet connectivity.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <a href="" class="stretched-link">
                <h3>Round Clock Security</h3>
              </a>
              <p>A full-time residential warden will be available in the hostel to take care of inmates. Hostel under CCTV surveillance system.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

  </main>

  <footer id="footer" class="footer">

    <br><br><br>

    <div class="container footer-top">
      <div class="row gy-4">

      <div class="col-lg-1 col-md-1 footer-links">
          <h4></h4>
          <ul>
            
          </ul>
        </div>
        <div class="col-lg-4 col-md-3 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">HMS</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Kakkanad P O</p>
            <p>Kakkanad</p>
            <p>Ernakulam</p>
            <p>683546</p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4></h4>
          <ul>
          <p class="mt-3"><strong>Phone:</strong> <span>+91 9745620479</span></p>
          <p><strong>Email:</strong> <span>hms@gmail.com</span></p>
          </ul>
        </div>
        <div class="col-lg-2 col-md-3 footer-links">
          <h4></h4>
          <ul>
          
          </ul>
        </div>

        <div class="col-lg-2 col-md-3">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>
  <br><br>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../Assets/Template/Student/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../Assets/Template/Student/vendor/php-email-form/validate.js"></script>
  <script src="../Assets/Template/Student/vendor/aos/aos.js"></script>
  <script src="../Assets/Template/Student/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../Assets/Template/Student/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../Assets/Template/Student/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="../Assets/Template/Student/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../Assets/Template/Student/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../Assets/Template/Student/js/main.js"></script>

</body>

</html>
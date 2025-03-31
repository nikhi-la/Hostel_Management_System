<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");

$selUser="select * from tbl_parent where user_id='".$_SESSION["user_id"]."'";
$rowu=$con->query($selUser);
$datau=$rowu->fetch_assoc();
if ($datau["verification_status"]==1 ||  $data['verification_status']==3)
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Leave Request</title>

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

  <!-- =======================================================
  * Template Name: eNno
  * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    input[type=submit],[type=reset] {
      color: var(--contrast-color);
      background: var(--accent-color);
      border: 0;
      padding: 10px 30px;
      transition: 0.4s;
      border-radius: 50px;
    }
    .services .service-item {
      background-color: var(--surface-color);
      border: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
      padding: 80px 80px;
      transition: border ease-in-out 0.3s;
      height: 60%;
      width: 100%;
    }
  </style>

</head>

<body class="index-page">
<?php
    include("header.php");

if(isset($_POST["btnsave"]))
{
    $selCurrentPassword="select user_password from tbl_user where user_id='".$_SESSION["user_id"]."'";
    $rowCurrentPassword=$con->query($selCurrentPassword);
    $dataCurrentPassword=$rowCurrentPassword->fetch_assoc();

    if($dataCurrentPassword["user_password"]==$_POST["currpassword"]){
      if($_POST["newpassword"]==$_POST["confirmpassword"]){
          $updateQry="update tbl_user set user_password='".$_POST["newpassword"]."' where user_id='".$_SESSION["user_id"]."'";
          if($con->query($updateQry)){
            ?>
              <script>
              alert("Password Changed");
              </script>
            <?php
          }
          else{
              ?>
                  <script>
                  alert("Password Failed to Change");
                  </script>
              <?php
          }
      }
      else{
          ?>
            <script>
            alert("Password Mismatch");
            </script>
        <?php
      }
    }
    else{
      ?>
          <script>
          alert("Current Password Incorrect");
          </script>
      <?php
    }
}

?>

  <main class="main">

  <center>
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">

<h2>Change Password</h2>
</div><!-- End Section Title -->
            <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
            <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-4">
                  Current Password
                </div>

                <div class="col-md-8">
                  
                  <input type="password" name="currpassword" id="currpassword"  class="form-control" autocomplete="off" required />
                </div>
                <br><br><br>
                <div class="col-md-4">
                  New Password
                </div>

                <div class="col-md-8">
                <input type="password" name="newpassword" id="newpassword" minlength="9" title="Password must be greater than 8 characters" class="form-control" autocomplete="off" required />
                </div>

                <br><br><br>

                <div class="col-md-4">
                  Confirm Password
                </div>

                <div class="col-md-8">
                <input type="password" name="confirmpassword" id="confirmpassword" minlength="9" title="Password must be greater than 8 characters" class="form-control" autocomplete="off" required />
                </div>

                
                
                <br><br><br><br><br><br>
                <div class="col-md-12 text-center">
                  <input type="submit" name="btnsave" id="btnsave" value="Submit" />
                  <input type="reset" name="btncancel" id="btncancel" value="Cancel" />
                 
                </div>

              </div>
            </form>
                    </div>
                    <br><br>

                </div>
            </section>
        </center>
  </main>
    <br><br><br><br>
<?php
 include("footer.php");
 ?>

</body>

</html>
<?php
}
else{
    ?>
        <script>
            alert("Unauthorized Access.Please Login!");
            window.location="../Login.php";
        </script>
    <?php
}
?>

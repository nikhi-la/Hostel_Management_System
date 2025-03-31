<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");

$selUser="select * from tbl_student where user_id='".$_SESSION["user_id"]."'";
$rowu=$con->query($selUser);
$datau=$rowu->fetch_assoc();
if ($datau["verification_status"]==1 || $datau["verification_status"]==3)
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Bill Summary</title>

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
    input[type=submit],[type=reset] {
      color: var(--contrast-color);
      background: var(--accent-color);
      border: 0;
      padding: 10px 30px;
      transition: 0.4s;
      border-radius: 50px;
    }

    .buttonstyle{
      color: var(--contrast-color);
      background: var(--accent-color);
      border: 0;
      padding: 10px 30px;
      transition: 0.4s;
      border-radius: 50px;
      width:20%;
    }
    .services .service-item {
      background-color: var(--surface-color);
      border: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
      padding: 80px 80px;
      transition: border ease-in-out 0.3s;
      height: 80%;
      width: 100%;
    }
  </style>

</head>

<body class="index-page">
<?php
    include("header.php");

  if(isset($_POST["btnPay"]))
  {
    $selQry="select * from tbl_messfee where user_id='".$_SESSION["user_id"]."' and year = year(CURRENT_DATE - INTERVAL 1 MONTH) and month = month(CURRENT_DATE - INTERVAL 1 MONTH)"; 
    $row=$con->query($selQry);
    $data=$row->fetch_assoc();

    $selRent="select * from tbl_hostelrentpayment where hostelrent_year = year(CURRENT_DATE - INTERVAL 1 MONTH) and hostelrent_month = month(CURRENT_DATE - INTERVAL 1 MONTH) and user_id='".$_SESSION["user_id"]."'";
    $rowRent=$con->query($selRent);
    $dataRowRent=$rowRent->fetch_assoc();

    if(mysqli_num_rows($row)>0 && mysqli_num_rows($rowRent)>0)
    {
      $_SESSION["messfeeid"]=$data["messfee_id"];
      $_SESSION["rentid"]=$dataRowRent["rent_id"];
          ?>
            <script>
            window.location="payment.php";
            </script>
          <?php
    }
    else{
      ?>
          <script>
            alert("Payment Cannot Process");
          window.location="billSummary.php";
          </script>
      <?php
    }
  }
?>

  <main class="main">

  <center>
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">

<h2>Payment</h2>
</div><!-- End Section Title -->
            <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
              <?php
                  
                  $selQry="select * from tbl_messfee where user_id='".$_SESSION["user_id"]."' and year = year(CURRENT_DATE - INTERVAL 1 MONTH) and month = month(CURRENT_DATE - INTERVAL 1 MONTH)"; 
                  $row=$con->query($selQry);
                   if(mysqli_num_rows($row)>0)
                   {
                    $data=$row->fetch_assoc();
                    ?>
                    <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                    <div class="row gy-4">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                      <b>Month</b>
                      </div>

                      <div class="col-md-8">
                        <?php
                          echo date("F", mktime(0, 0, 0, $data["month"], 1))." ".$data["year"];
                        ?>
                      </div>
                      <br><br><br>
                      
                      <div class="col-md-1"></div>
                    <div class="col-md-3">
                      <b>Mess Fee</b>
                      </div>

                      <div class="col-md-8">
                        <?php
                          echo $data["mess_fees"]." Rs.";
                        ?>
                      </div>
                      <br><br><br>

                      <div class="col-md-1"></div>
                    <div class="col-md-3">
                      <b>Hostel Rent</b>
                      </div>
                      <?php
                  
                  $selRent="select * from tbl_hostelrentpayment where hostelrent_year = year(CURRENT_DATE - INTERVAL 1 MONTH) and hostelrent_month = month(CURRENT_DATE - INTERVAL 1 MONTH) and user_id='".$_SESSION["user_id"]."'";
                  $rowRent=$con->query($selRent);
                   if(mysqli_num_rows($rowRent)>0)
                   {
                    $datarent=$rowRent->fetch_assoc();
                    ?>
                      <div class="col-md-8">
                        <?php
                          echo $datarent["room_rent"]." Rs.";
                        ?>
                      </div>
                      <?php
                   }
                   else{
                    ?>
                      <div class="col-md-8">
                        <?php
                          echo "No Rent Added";
                        ?>
                      </div>
                      <?php
                   }
                   ?>

                      <br><br><br>

                      <div class="col-md-1"></div>
                    <div class="col-md-3">
                      <b>Due Amount</b>
                      </div>

                      <div class="col-md-8">
                        <?php
                          echo $data["due_amount"]." Rs.";
                        ?>
                      </div>

                      <br><br><br>

                      <div class="col-md-1"></div>
                    <div class="col-md-3">
                      <b>Total Amount Payable</b>
                      </div>

                      <div class="col-md-8">
                      <?php
                      if(mysqli_num_rows($rowRent)>0)
                      {
                        $rent=$datarent["room_rent"];
                      }
                      else{
                        $rent=0;
                      }
                          echo $data["mess_fees"]+$rent+$data["due_amount"]." Rs.";
                        ?>
                      </div>

                      <br><br><br>
                      <div class="col-md-12 text-center">
                        <?php
                          if($data["payment_status"]==0)
                          {
                        ?>
                        <input type="submit" name="btnPay" id="btnPay" value="Pay" />
                        <?php
                          }
                          else{
                              ?><center><div class="buttonstyle">Payed</div></center><?php
                          }
                          ?>
                      
                      </div>

                      </div>        
                  </form>
                    <?php
                  }
                  else{
                    ?>
                    <script>
                    alert("No Bill");
                    window.location="../index.php";
                    </script>
                    <?php
                  }
                  ?>
                  
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

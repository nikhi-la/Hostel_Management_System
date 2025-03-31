<?php
session_start();
include("../Assets/Connection/Connection.php");
//echo $_SESSION["user_id"].$_SESSION["user_type"];

if(isset($_SESSION["user_id"]) && ($_SESSION["user_type"]=="student") )
{
	$sel="select verification_status from tbl_student where user_id='".$_SESSION["user_id"]."'";
	$row = $con->query($sel);
	$data = $row->fetch_assoc();
	//echo $data['verification_status'];
	if($data['verification_status']==1 || $data['verification_status']==3){

    $selUser="select * from tbl_student where user_id='".$_SESSION["user_id"]."'";
    $rowu=$con->query($selUser);
    $datau=$rowu->fetch_assoc();

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      
      <title>Caution Deposit</title>

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

        if(isset($_POST["btnPay"])){
                ?>
                <script>
                    window.location="cDPayment.php";
                </script>
                <?php
        }
    ?>

      <main class="main">

      <center>
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Caution Deposit</h2>
        </div><!-- End Section Title -->
                <section id="services" class="services section light-background">
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                        <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                          <b>Date</b>
                          </div>

                          <div class="col-md-8">
                            <?php
                              echo date("d-m-y");
                            ?>
                          </div>
                          <br><br><br>
                          
                          <div class="col-md-1"></div>
                        <div class="col-md-3">
                          <b>Amount</b>
                          </div>

                          <div class="col-md-8">
                            3000 Rs.
                          </div>
                          <br><br><br>
    
                          <div class="col-md-12 text-center">
                            <?php
                              if($datau["caution_deposit_status"]!=1){
                                ?>
                                    <input type="submit" name="btnPay" id="btnPay" value="Pay" />
                                <?php
                              } 
                              else{
                                ?>
                                    <center><div class="buttonstyle">Payed</div></center><br>
                                    <a href="CDReceipt.php" style="font-size:20px;"><b>Receipt</b></a>
                                <?php
                              }
                            ?>
                            
                            
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
              alert("Invalid User");
              window.location="../Login.php";
       </script>
    <?php

}
}
else{
    ?>
        <script>
            alert("Unauthorized Access.Please Login!");
            window.location="../Login.php";
        </script>
    <?php
}
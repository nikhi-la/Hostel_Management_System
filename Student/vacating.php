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
      
      <title>Vacate</title>

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

        if(isset($_POST["vacate"])){

          $isVacatingMonthfeeAlreadyAdded="select * from tbl_messfee where user_id = '".$_SESSION["user_id"]."' AND month = MONTH(CURRENT_DATE) AND year = YEAR(CURRENT_DATE)";
          $rowIsVacatingMonthfeeAlreadyAdded=$con->query($isVacatingMonthfeeAlreadyAdded);
          if(mysqli_num_rows($rowIsVacatingMonthfeeAlreadyAdded)>0){
            $status = 3; # 3 means going to vacate. Payment remains
                  $updateQry = "UPDATE tbl_student SET verification_status='$status' WHERE user_id='" . $_SESSION["user_id"] . "'";
                  $con->query($updateQry);

                  $updateParentQry = "UPDATE tbl_parent SET verification_status='$status' WHERE student_id='" .$_SESSION["user_id"] . "'";
                  $con->query($updateParentQry);

          }
          else{
            $vacatingMonthAttendanceQry = "SELECT COUNT(*) as present_days FROM tbl_attendance  WHERE attendance_status = 1 
            AND user_id = '".$_SESSION["user_id"]."' AND MONTH(attendance_date) = MONTH(CURRENT_DATE) AND YEAR(attendance_date) = YEAR(CURRENT_DATE)";
            $rowVacatingMonthAttendance = $con->query($vacatingMonthAttendanceQry);
            $dataVacatingMonthAttendance=$rowVacatingMonthAttendance->fetch_assoc();

            if($dataVacatingMonthAttendance["present_days"]==0){
              $status = 3; # 3 means going to vacate. Payment remains
                  $updateQry = "UPDATE tbl_student SET verification_status='$status' WHERE user_id='" . $_SESSION["user_id"] . "'";
                  $con->query($updateQry);

                  $updateParentQry = "UPDATE tbl_parent SET verification_status='$status' WHERE student_id='" .$_SESSION["user_id"] . "'";
                  $con->query($updateParentQry);
            }
            else{

              $month = date("n"); 
              $year = date("Y");

              $selMessExpense="select mess_expense from tbl_basic where basic_id=1";
              $rowMessExpense=$con->query($selMessExpense);
              $dataMessExpense=$rowMessExpense->fetch_assoc();

              $expense = $dataMessExpense["mess_expense"];


              $selHostelRent="Select * from tbl_roompreference rp inner join tbl_room r on rp.room_id=r.room_id where user_id='".$_SESSION["user_id"]."'";
              $rowSelHosteRent=$con->query($selHostelRent);
              $dataSelHosteRent=$rowSelHosteRent->fetch_assoc();

              $hostelrent = $dataSelHosteRent["room_rent"];

              if($dataVacatingMonthAttendance["present_days"]<=15){
                $messfees=$expense/2;
                $hostelfees=$hostelrent/2;
              }
              else{
                $messfees=$expense;
                $hostelfees=$hostelrent;
              }
              
              $insQry="insert into tbl_messfee(month,year,user_id,present_count,mess_fees,added_date,payment_status)values
              ('".$month."','".$year."','".$_SESSION["user_id"]."','".$dataVacatingMonthAttendance["present_days"]."','".$messfees."',curdate(),0)";
              if($con->query($insQry)){

                  $insQryRoomRent="insert into tbl_hostelrentpayment(user_id,hostelrent_month,hostelrent_year,room_share,room_rent,payment_status)
                  values('".$_SESSION["user_id"]."','".$month."','".$year."','".$dataSelHosteRent["room_capacity"]."','".$hostelfees."',0)";
                  $con->query($insQryRoomRent);

                  $status = 3; # 3 means going to vacate. Payment remains
                  $updateQry = "UPDATE tbl_student SET verification_status='$status' WHERE user_id='" . $_SESSION["user_id"] . "'";
                  $con->query($updateQry);

                  $updateParentQry = "UPDATE tbl_parent SET verification_status='$status' WHERE student_id='" .$_SESSION["user_id"] . "'";
                  $con->query($updateParentQry);
              }
            }
          }

          $selMessFee="select * from tbl_messfee where user_id='".$_SESSION["user_id"]."' and payment_status=0";
          $rowMessFee=$con->query($selMessFee);

          if(mysqli_num_rows($rowMessFee)>0){
            ?>
                <script>
                alert("Payment Pending");
                window.location="viewPreviousBills.php";
                </script>
            <?php
          }
          else{
            ?>
            <script>
            alert("Please wait. Vacating Process is under verification.We will inform once the process completed");
            </script>
        <?php
          }

        }
    ?>

      <main class="main">

      <center>
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            
        </div><!-- End Section Title -->
                <section id="services" class="services section light-background">
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                        <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">
                        <div class="col-md-1"></div>
                        <h1>Continue with vaccating ?</h1>
                        <center>
                          <input type="submit" name="vacate" id="vacate" value="Vacate"  style="width: 200px;" />
                        </center>
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
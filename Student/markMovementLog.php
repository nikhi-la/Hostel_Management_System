<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");

$selUser="select * from tbl_student where user_id='".$_SESSION["user_id"]."'";
$rowu=$con->query($selUser);
$datau=$rowu->fetch_assoc();
if ($datau["verification_status"]==1 || $datau["verification_status"] == 3 )
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Movement Log</title>

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

  if(isset($_POST["btnOut"])){
    $insQry = "insert into tbl_movement(user_id,out_date,out_time,in_date,in_time,reason,out_status)values('".$_SESSION["user_id"]."',curdate(),'".$_POST["outtime"]."',null,null,'".$_POST["reason"]."',1)";
    if($con->query($insQry)){
      ?>
        <script>
        alert("Marked Check Out");
        window.location="markMovementLog.php";
        </script>
      <?php
    }
    else{
      ?>
      <script>
        alert("Check Out Marking Failed");
        window.location="markMovementLog.php";
        </script>
        <?php
    }
  }
  if(isset($_POST["btnIn"])){
    $updateQry = "update tbl_movement set in_date=curdate(),in_time='".$_POST["intime"]."',out_status=0 where movement_id='".$_POST["movementid"]."'";
    if($con->query($updateQry)){
      ?>
        <script>
        alert("Marked Check In");
        window.location="markMovementLog.php";
        </script>
      <?php
    }
    else{
      ?>
      <script>
        alert("Check In Marking Failed");
        window.location="markMovementLog.php";
        </script>
        <?php
    }
  }
?>

  <main class="main">

  <center>
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">

<h2>Movement Log</h2>
</div><!-- End Section Title -->
            <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
            <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <?php
                $selQry="select * from tbl_movement where user_id='".$_SESSION["user_id"]."' order by movement_id desc";
                //echo $selQry;
                $row=$con->query($selQry);
                $data=$row->fetch_assoc();
                date_default_timezone_set("Asia/Kolkata");
                if((mysqli_num_rows($row)==0) || ($data["out_status"]==0))
                {
                  ?>
                      <div class="row gy-4">

                      <div class="col-md-4">
                      Out Date
                      </div>

                      <div class="col-md-8">
                        
                        <input type="date" name="outdate" id="outdate" class="form-control" value="<?php echo date("Y-m-d")?>" readonly required />
                      </div>
                      <br><br><br>

                      <div class="col-md-4">
                      Out Time
                      </div>

                      <div class="col-md-8">      
                     <input type="text" name="outtime" id="outtime" class="form-control" value="<?php echo date("h:i:sa")?>" readonly required />
                      </div>
                      <br><br><br>

                      <div class="col-md-4">
                        Reason
                      </div>

                      <div class="col-md-8">
                        <textarea name="reason" id="reason" autocomplete="off" class="form-control" required ></textarea>
                      </div>

                      <br><br><br><br><br><br>
                      <div class="col-md-12 text-center">

                        <input type="submit" name="btnOut" id="btnOut" value="Mark Out" />
                      
                      </div>

                      </div>
                  <?php
                }
                else{
                  ?>
                      <div class="row gy-4">

                      <div class="col-md-4">
                      Out Date
                      </div>

                      <div class="col-md-8">
                      <input type="hidden" name="movementid" id="movementid" class="form-control" value="<?php echo $data["movement_id"]?>" readonly required />
                        <input type="date" name="outdate" id="outdate" class="form-control" value="<?php echo $data["out_date"]?>" readonly required />
                      </div>
                      <br><br><br>
                      <div class="col-md-4">
                      Out Time
                      </div>

                      <div class="col-md-8">
                        
                        <input type="text" name="outtime" id="outtime" class="form-control"value="<?php echo $data["out_time"]?>" readonly required />
                      </div>
                      <br><br><br>

                      <div class="col-md-4">
                      In Date
                      </div>

                      <div class="col-md-8">
                        
                        <input type="date" name="outdate" id="outdate" class="form-control" value="<?php echo date("Y-m-d")?>" readonly required />
                      </div>
                      <br><br><br>

                      <div class="col-md-4">
                      In Time
                      </div>

                      <div class="col-md-8">
                        
                        <input type="text" name="intime" id="intime" class="form-control" value="<?php echo date("h:i:sa")?>" readonly required />
                      </div>
                      <br><br><br>

                      <div class="col-md-4">
                        Reason
                      </div>

                      <div class="col-md-8">
                        <textarea name="reason" id="reason" autocomplete="off" class="form-control"  readonly required ><?php echo $data["reason"]?></textarea>
                      </div>

                      <br><br><br><br><br><br>
                      <div class="col-md-12 text-center">

                        <input type="submit" name="btnIn" id="btnIn" value="Mark In" />
                      
                      </div>

                      </div>
                  <?php   
                }
              ?>
              
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

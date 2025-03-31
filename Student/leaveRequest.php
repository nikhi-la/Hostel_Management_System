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
    $status=0;
    $leaveInsQry="insert into tbl_leave(user_id,from_date,to_date,applied_date,leave_reason,leave_status)values('".$_SESSION["user_id"]."','".$_POST["fromdate"]."','".$_POST["todate"]."',curdate(),'".$_POST["reason"]."','".$status."')";
    if($con->query($leaveInsQry))
        {
            ?>
                <script>
                alert("Leave Request submitted");
                window.location="leaveRequest.php";
                </script>
            <?php
        }
        else{
            ?>
                <script>
                alert("Leave Request Submission Failed");
                window.location="leaveRequest.php";
                </script>
            <?php
        }

}

if(isset($_GET["did"]))
{
	$delQry="delete from tbl_leave where leave_id=".$_GET["did"]."";
	$con->query($delQry);
			?>
			<script>
             alert("Leave Request deleted");
             window.location="leaveRequest.php";
			</script>
			<?php
}

?>

  <main class="main">

  <center>
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">

<h2>Request for Leave</h2>
</div><!-- End Section Title -->
            <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
            <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-4">
                  From Date
                </div>

                <div class="col-md-8">
                  
                  <input type="date" name="fromdate" id="fromdate" class="form-control" required />
                </div>
                <br><br><br>
                <div class="col-md-4">
                  To Date
                </div>

                <div class="col-md-8">
                  <input type="date" name="todate" id="todate" class="form-control" required />
                </div>

                <br><br><br>

                <div class="col-md-4">
                  Leave Reason
                </div>

                <div class="col-md-8">
                  <textarea name="reason" id="reason" autocomplete="off" class="form-control" required ></textarea>
                </div>

                
                
                <br><br><br><br><br><br>
                <div class="col-md-12 text-center">

                <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
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


      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
          <br><br>
          <h2>Applied Leaves</h2>
      </div><!-- End Section Title -->
      <center>
      <section id="services" class="services section light-background">
                <div class="col-lg-8 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
        <table class="form-control" border="0" cellpadding="10">
    <tr>
      <th width="8%">Sl.No.</th>
      <th width="14%">From Date</th>
      <th width="14%">To Date</th>
      <th width="50%">Reason</th>
      <th width="14%">Applied Date</th>
      <th width="10%">Action</th>
    </tr>
   
    <?php
      $selRequest="select * from tbl_leave where user_id='".$_SESSION["user_id"]."'";
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["from_date"]?></td>
          <td><?php echo $data["to_date"]?></td>
          <td><?php echo $data["leave_reason"]?></td>
          <td><?php echo $data["applied_date"]?></td>
          <td>
          <?php if ($data["leave_status"]==0)
                  {
                      ?>
                      <a href="leaveRequest.php?did=<?php echo $data['leave_id']; ?>">Delete</a>
                      <?php
                  }
                  else if ($data["leave_status"]==1)
                  {
                      echo "Accepted";
                  }
                  else{
                      echo "Rejected";
                  }
                  ?>
          
          </td>
        </tr>
        <?php

      }

    ?>
  </table>
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

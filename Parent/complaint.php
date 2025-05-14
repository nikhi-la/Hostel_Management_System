<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpmailer/src/Exception.php';
require '../Assets/phpmailer/src/PHPMailer.php';
require '../Assets/phpmailer/src/SMTP.php';

$selUser="select * from tbl_parent where user_id='".$_SESSION["user_id"]."'";
$rowu=$con->query($selUser);
$datau=$rowu->fetch_assoc();
if ($datau["verification_status"]==1 || $datau['verification_status']==3)
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Complaints</title>

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
      height: 50%;
      width: 100%;
    }
  </style>

</head>

<body class="index-page">
<?php
    include("header.php");

if(isset($_POST["btnsave"]))
{
    $complaintInsQry="insert into tbl_complaint(complaint,complaint_date,user_id,reply_date,complaint_reply,complaint_status)values('".$_POST["complaint"]."',curdate(),'".$_SESSION["user_id"]."',null,null,0)";
    if($con->query($complaintInsQry))
        {
          //Sending Email Start
          $mail = new PHPMailer(true);

          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'hmshostel@gmail.com';
          $mail->Password= 'zhlljothtysockzf';
          $mail->SMTPSecure = 'ssl';
          $mail->Port = 465;

          $mail->setFrom('hmshostel@gmail.com');

          $selEmail="select user_email from tbl_user where user_id='".$_SESSION["user_id"]."'";
          $rowEmail=$con->query($selEmail);
          $dataEmail=$rowEmail->fetch_assoc();

          $mail->addAddress($dataEmail["user_email"]);

          $mail->isHTML(true);

          $mail->Subject = "Complaint Added";
          $mail->Body= "Complaint SUbmitted to Warden.";

          $mail->send();
          //Sending Email End

            ?>
                <script>
                alert("Complaint submitted");
                window.location="complaint.php";
                </script>
            <?php
        }
        else{
            ?>
                <script>
                alert("Complaint Submission Failed");
                window.location="complaint.php";
                </script>
            <?php
        }

}

if(isset($_GET["did"]))
{
	$delQry="delete from tbl_complaint where complaint_id=".$_GET["did"]."";
	$con->query($delQry);
			?>
			<script>
             alert("Complaint deleted");
             window.location="complaint.php";
			</script>
			<?php
}

?>

  <main class="main">

  <center>
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">

<h2>Complaint</h2>
</div><!-- End Section Title -->
            <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
            <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-4">
                  Complaint
                </div>

                <div class="col-md-8">
                  <textarea name="complaint" id="complaint" autocomplete="off" class="form-control" rows="5" required ></textarea>
                </div>
                
                <br><br><br><br><br><br><br><br>
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


      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
          <br><br>
          <h2>Complaints Submitted</h2>
      </div><!-- End Section Title -->
      <center>
      <section id="services" class="services section light-background">
                <div class="col-lg-8 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
        <table class="form-control" border="0" cellpadding="10">
    <tr>
      <th width="5%">Sl.No.</th>
      <th width="11%">Date</th>
      <th>Complaint</th>
      <th width="11%">Reply Date</th>
      <th>Reply</th>
      <th width="11%">Action</th>
      <th width="11%">Status</th>
    </tr>
   
    <?php
      $selRequestStudent="select student_id from tbl_parent where user_id='".$_SESSION["user_id"]."'";
      $rowRequestStudent=$con->query($selRequestStudent);
      $dataRequestStudent=$rowRequestStudent->fetch_assoc();

      $selRequest="select * from tbl_complaint where user_id='".$_SESSION["user_id"]."' or user_id='".$dataRequestStudent["student_id"]."' order by complaint_date desc";
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["complaint_date"]?></td>
          <td><?php echo $data["complaint"]?></td>
          <td><?php echo $data["reply_date"]?></td>
          <td><?php echo $data["complaint_reply"]?></td>
          <td>
          <?php if ($data["complaint_status"]==0)
                  {
                      ?>
                      <a href="complaint.php?did=<?php echo $data['complaint_id']; ?>">Delete</a>
                      <?php
                  }
                  else 
                  {
                      echo "Accepted";
                  }
                  ?>
          
          </td>
          <td>
          <?php if ($data["complaint_status"]==0 || $data["complaint_status"]==1 )
                  {
                    echo "Pending";
                      ?>
                      
                      <?php
                  }
                  else 
                  {
                      echo "Solved";
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

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
  
  <title>Room Change Request</title>

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
            height: 70%;
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
        $roomChangeInsQry="insert into tbl_roomchangerequest(user_id,room_id,reason,requested_room_id,roomchange_status)values('".$_SESSION["user_id"]."','".$_POST["currentroom"]."','".$_POST["reason"]."','".$_POST["roomid"]."','".$status."')";
        if($con->query($roomChangeInsQry))
        {
            ?>
                <script>
                alert("Request submitted");
                </script>
            <?php
        }
        else{
            ?>
                <script>
                alert("Request Submission Failed");
                </script>
            <?php
        }
    }

    if(isset($_GET["roomchangeid"]))
    {
        $deleteChangeRequest="delete from tbl_roomchangerequest where request_id='".$_GET["roomchangeid"]."'";
        if($con->query($deleteChangeRequest))
        {
            ?>
                <script>
                alert("Request Deleted");
                window.location="roomChangeRequest.php";
                </script>
            <?php
        }
        else{
            ?>
                <script>
                alert("Request Deletion Failed");
                </script>
            <?php
        }
    }

?>

  <main class="main">

  <center>
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">

<h2>Request for Room Change</h2>
</div><!-- End Section Title -->
            <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
            <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

              <?php
                $currentRoom="select * from tbl_room r inner join tbl_roompreference rp on r.room_id=rp.room_id and user_id='".$_SESSION["user_id"]."' and room_verification_status=1";
                $row=$con->query($currentRoom);
                if(mysqli_num_rows($row)>0)
                {
                  $data=$row->fetch_assoc();
                    ?>
                       <div class="col-md-12">
                  <label for="curroom" class="pb-2">Current Room</label>
                  <input type="hidden" name="currentroom" id="currentroom" value="<?php echo $data["room_id"]?>"/>
                  <input type="text" name="curroom" id="curroom"  class="form-control" value="<?php echo "Floor ".$data["room_floor"]." Room Number ".$data["room_number"];?>" readonly autocomplete="off" required=""/>
                </div>
                    <?php
                }
                else{
                  ?>
                  <div class="col-md-12">
                  <label for="curroom" class="pb-2">Current Room</label>
                  <input type="hidden" name="currentroom" id="currentroom" value="<?php echo 0;?>"/>
                  <input type="text" name="curroom" id="curroom"  class="form-control" value="Not yet Allocated" readonly autocomplete="off" required=""/>
                </div>
                <?php
                }
              ?>
               

                <div class="col-md-12">
                  <label for="reason" class="pb-2">Reason</label>
                  <textarea name="reason" id="reason" class="form-control" autocomplete="off" required ></textarea>
                </div>

                <div class="col-md-12">
                  <label for="roomid" class="pb-2">Requested Room</label><br>
                  <select name="roomid" id="roomid" required class="form-control">
                        <option selected="selected" value="">---select---</option>
                        <?php
                          $selQry="select * from tbl_room";
                          $row=$con->query($selQry);
                          while($data=$row->fetch_assoc())
                          {
                          ?>      
                              <option value=<?php echo $data["room_id"]?>><?php echo "Floor ".$data["room_floor"]." Room Number ".$data["room_number"]?></option>
                              <?php
                          }
                          ?>
                  </select>
                  
                </div>
                <br><br><br><br>
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
          <h2>Requests</h2>
      </div><!-- End Section Title -->
      <center>
      <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
        <table class="form-control" border="0" cellpadding="10">
    <tr>
      <th width="15%" >Id</th>
      <th width="30%">Room</th>
      <th width="40%">Reason</th>
      <th width="15%">Status</th>
    </tr>
    <?php
    $selRequest="select * from tbl_roomchangerequest rcr inner join tbl_room r on r.room_id=rcr.requested_room_id where user_id='".$_SESSION["user_id"]."'";
	$rowr=$con->query($selRequest);
	$i=0;
	while($datar=$rowr->fetch_assoc())
	{
		$i++;
    ?>
	<tr>
      <td><?php echo $i;?></td>
      <td><?php echo "Floor ".ucfirst($datar["room_floor"])." Room Number ".ucfirst($datar["room_number"]);?></td>
      <td><?php echo $datar["reason"];?></td>
      <td><?php if ($datar["roomchange_status"]==0)
                {
                    ?>
            <a href="roomChangeRequest.php?roomchangeid=<?php echo $datar["request_id"]; ?>">Delete</a>
                    <?php
                }
                else if ($datar["roomchange_status"]==1)
                {
                    echo "Accepted";
                }
                else{
                    echo "Rejected";
                }?>
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


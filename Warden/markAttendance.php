<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mark Attendance</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/css/vendor.bundle.base.css">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="../Assets/Template/Warden/css/style.css">
    <link rel="shortcut icon" href="../Assets/Template/Warden/images/Logo.png" />
</head>
<style>
.back-button {
    position: fixed;
    bottom: 40px;
    right: 100px;
    z-index: 1000;
    padding: 10px 15px;
    font-size: 18px;
    border-radius: 50%;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
}
.back-button:hover {
    background-color: #555;
}
.front-button {
    position: fixed;
    bottom: 40px;
    right: 50px;
    z-index: 1000;
    padding: 10px 15px;
    font-size: 18px;
    border-radius: 50%;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
}
.front-button:hover {
    background-color: #555;
}
</style>
<body>

    <?php
    include("../Assets/Connection/Connection.php");
    include("SessionValidator.php");
    
    if(isset($_POST["butabsent"])){
      $userids = $_POST['userid'];
      $status=0;
      $date=date("Y-m-d");
    
      $values = [];
        foreach ($userids as $index => $userids) {
            $values[] = "('$date','$userids', $status )";
        }


      $absentInsQry="insert into tbl_attendance (attendance_date, user_id, attendance_status) values " . implode(",", $values);
      if($con->query($absentInsQry))
      {
        ?>
        <script>
        alert("Absent Submitted");
        </script>
        <?php
        }
      else{
        ?>
        <script>
        alert("Absent Failed to submit");
        </script>
        <?php
      }
    
    }
    
    if(isset($_POST["butpresent"])){
      $userids = $_POST['userpresentid'];
      $status=1;
      $date=date("Y-m-d");
    
      $values = [];
        foreach ($userids as $index => $userids) {
            $values[] = "('$date','$userids', $status )";
        }
    
      $absentInsQry="insert into tbl_attendance (attendance_date, user_id, attendance_status) values " . implode(",", $values);
      if($con->query($absentInsQry))
      {
        ?>
        <script>
        alert("Present Submitted");
        </script>
        <?php
        }
      else{
        ?>
        <script>
        alert("Present Failed to submit");
        </script>
        <?php
      }
    
    }
    

    ?>

    <div class="container-scroller">
        <?php include("header.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include("sidebar.php"); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                        <h4 class="card-title text-dark" style="font-size: 30px;">Mark Attendance</h4><br>
                        <h5 class="card-title text-dark" style="font-size: 20px;"><?php echo date("d F Y"); ?></h5><br>
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Absent</h4>
                                <form id="form1" name="form1" method="post" action="">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl No</th>
      <th>Student Name</th>
      <th>From Date</th>
      <th>To Date</th>
      <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
	$absentSelQry="select * from tbl_leave l inner join tbl_student s on l.user_id=s.user_id where leave_status=1 and curdate() between from_date and to_date and verification_status = 1 or verification_status = 3 ";
  #echo $absentSelQry;
	$rowabsent=$con->query($absentSelQry);
  if(mysqli_num_rows($rowabsent)==0){
    ?>
      <tr>
      <td colspan="5" style="font-size:18px;"><center>No Absentees</center></td>
      </tr>
    <?php
  }
  else{
      	$i=0;
	while($dataabsent=$rowabsent->fetch_assoc())
	{

      $i++;
      ?>
    
      <tr>
        <td>&nbsp;<?php echo $i; ?></td>
        <td>&nbsp;<input type="hidden" name="userid[]" value="<?php echo $dataabsent["user_id"] ?>">
          <?php echo $dataabsent["student_firstname"]." ".$dataabsent["student_middlename"]." ".$dataabsent["student_lastname"] ?></td>
        <td>&nbsp;<?php echo $dataabsent["from_date"] ?></td>
        <td>&nbsp;<?php echo $dataabsent["to_date"] ?></td>
        <td><b><?php echo "Absent"; ?></b></td>
      <?php 
	}
	?>
    </tr>
     <tr>
      <td height="42" colspan="5"><div align="center">
        <?php
            $sel="select * from tbl_attendance where attendance_date=curdate() and attendance_status=0";
            $rowSel=$con->query($sel);
            if(mysqli_num_rows($rowSel)==0){
        ?>
          <input type="submit" name="butabsent" id="butabsent" class="btn btn-danger btn-fw" style="font-size: 15px;" value="Mark Absent" />
          <?php
          }
          else{
            ?>
                <div style="color: red;font-size:15px"><b><br><br>Absent Marked</b></div>
            <?php
          }
          ?>
        </div></td>
    </tr>
    <?php
  }
  ?>
                                    </tbody>
                                </table>
</form>
                            </div>
                        </div>
                    </div> 

                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Present</h4>
                                <form id="form1" name="form1" method="post" action="">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl No</th>
      <th>Student Name</th>
      <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
	$presentSelQry="select * from tbl_student where user_id not in (select l.user_id from tbl_leave l inner join tbl_student s on l.user_id=s.user_id where leave_status=1 and curdate() between from_date and to_date) and verification_status = 1 or verification_status = 3";
  #echo $presentSelQry;
	$rowpresent=$con->query($presentSelQry);
  if(mysqli_num_rows($rowpresent)==0){
    ?>
      <tr>
      <td colspan="5" style="font-size:18px;"><center>No Presentees</center></td>
      </tr>
    <?php
  }
  else{

	$i=0;
	while($datapresent=$rowpresent->fetch_assoc())
	{
      $i++;
      ?>
    
      <tr>
        <td>&nbsp;<?php echo $i; ?></td>
        <td>&nbsp;&nbsp;<input type="hidden" name="userpresentid[]" value="<?php echo $datapresent["user_id"] ?>">
          <?php echo $datapresent["student_firstname"]." ".$datapresent["student_middlename"]." ".$datapresent["student_lastname"] ?></td>
        <td><b><?php echo "Present"; ?></b></td>
      <?php 
    
	}
	?>
    </tr>
   

     <tr>
      <td height="42" colspan="5"><div align="center">
      <?php
            $sel="select * from tbl_attendance where attendance_date=curdate() and attendance_status=1";
            $rowSel=$con->query($sel);
            if(mysqli_num_rows($rowSel)==0){
        ?><br><br>
        <input type="submit" name="butpresent" id="butpresent" value="Mark Present" style="font-size: 15px;" class="btn btn-success btn-fw" />
        <?php
          }
          else{
            ?>
                <div style="color: green;font-size:15px"><b><br><br>Present Marked</b></div>
            <?php
          }
          ?>
      </div></td>
    </tr>
    <?php
  }
  ?>
                                    </tbody>
                                </table>
</form>
                            </div>
                        </div>
                        <!-- Back Button -->
                        <button class="btn btn-dark btn-rounded btn-icon back-button" onclick="goBack()">⬅</button>
                    </div> 
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include("footer.php"); ?>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var now = new Date();
        var hours = now.getHours();
        var button = document.getElementById("butabsent");

        // Disable button before 6 PM (18:00)
        if (hours < 18) {
            button.disabled = true;
            button.title = "Marking attendance is only available after 6 PM";
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var now = new Date();
        var hours = now.getHours();
        var button = document.getElementById("butpresent");

        // Disable button before 6 PM (18:00)
        if (hours < 18) {
            button.disabled = true;
            button.title = "Marking present is only available after 6.00 PM";
        }
    });
function goBack() {
    window.history.back();
}

</script>
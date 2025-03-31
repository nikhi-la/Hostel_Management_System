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
    
    if(isset($_GET["presentattendanceid"])){
        $updateQry="update tbl_attendance set attendance_status=1 where attendance_id='".$_GET["presentattendanceid"]."'";
        $con->query($updateQry);
        ?>
            <script>
                window.location="viewAttendance.php";
            </script>
        <?php
    }
    if(isset($_GET["absentattendanceid"])){
        $updateQry="update tbl_attendance set attendance_status=0 where attendance_id='".$_GET["absentattendanceid"]."'";
        $con->query($updateQry);
        ?>
        <script>
            window.location="viewAttendance.php";
        </script>
    <?php
    }


    ?>

    <div class="container-scroller">
        <?php include("header.php"); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include("sidebar.php"); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                        <h4 class="card-title text-dark" style="font-size: 30px;">Attendance</h4><br>
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                
                                <form id="form1" name="form1" method="post" action="">

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                    <th colspan="1" style="text-align: right;">Search by Date<br><br><br><br><br><br><br><br></th>

                                        <th colspan="2"><center>
                                            <div class="col-sm-10"><input type="date" name="searchdate" id="searchdate" autocomplete="off"/></div>
                                            <br><br><br><br><br><br><br>
                                        </th>
                                        <th colspan="2">
                                        <input type="submit" name="butSearch" id="butSearch" value="Search" style="font-size: 15px;" class="btn btn-info btn-rounded btn-fw" /></center>
                                            <br><br><br><br><br><br><br>
                                        </th></tr>
                                        <tr>
                                        <th>Sl No</th>
      <th>Student Name</th>
      <th>Date</th>
      <th>Attendance</th>
      <th>Change To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    if(isset($_POST["butSearch"])){
        $selQry="select * from tbl_attendance a inner join tbl_student s on a.user_id=s.user_id where attendance_date='".$_POST["searchdate"]."' order by attendance_date desc,student_firstname";
    }
    else{
        $selQry="select * from tbl_attendance a inner join tbl_student s on a.user_id=s.user_id order by attendance_date desc,student_firstname";
    }
	
  #echo $absentSelQry;
	$row=$con->query($selQry);
  if(mysqli_num_rows($row)==0){
    ?>
      <tr>
      <td colspan="5" style="font-size:18px;"><center>No Records</center></td>
      </tr>
    <?php
  }
  else{
      	$i=0;
	while($data=$row->fetch_assoc())
	{
    
      $i++;
      ?>
    
      <tr>
        <td>&nbsp;<?php echo $i; ?></td>
        <td>&nbsp;<input type="hidden" name="userid" value="<?php echo $data["user_id"] ?>">
          <?php echo $data["student_firstname"]." ".$data["student_middlename"]." ".$data["student_lastname"] ?></td>
        <td>&nbsp;<?php echo $data["attendance_date"] ?></td>
        <td><?php 
        if($data["attendance_status"]==1){
            ?><div style="color: green;font-size:15px"><b>Present</b></div> <?php
        }
        else{
            ?><div style="color: red;font-size:15px"><b>Absent</b></div> <?php
        }
        ?></td>
        <td><?php 
        if($data["attendance_status"]==1){
            ?><a href="viewAttendance.php?absentattendanceid=<?php echo $data["attendance_id"] ?>" class="btn btn-danger" style="font-size: 13px;">Absent</a><?php
        }
        else{
            ?>
            <a href="viewAttendance.php?presentattendanceid=<?php echo $data["attendance_id"] ?>" class="btn btn-success" style="font-size: 13px;">Present</a>
            <?php
        }
        ?>   
        </td>
       
      <?php 
	}
	?>
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
function goBack() {
    window.history.back();
}

</script>
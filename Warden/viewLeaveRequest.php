<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Leave Request</title>
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
    include('../email.php');

    
    if(isset($_GET["aid"]))
    {
        $status=1;
        $leaveRequestUpdateQry="update tbl_leave set leave_status='".$status."' where leave_id='".$_GET["aid"]."'";
        $con->query($leaveRequestUpdateQry);
        
        //Email Start

        $selLeave="select * from tbl_leave where leave_id='".$_GET["aid"]."'";
        $rowLeave=$con->query($selLeave);
        $dataLeave=$rowLeave->fetch_assoc();

        $selStudent="select * from tbl_student s inner join tbl_user u on s.user_id=u.user_id where s.user_id='".$dataLeave['user_id']."'";
        $rowSelStudent=$con->query($selStudent);
        $dataSelStudent=$rowSelStudent->fetch_assoc();

        

        $recipientEmail= $dataSelStudent["user_email"];
        $subject="Leave Approved";

        $message = "Dear " . $dataSelStudent["student_firstname"] . " " . $dataSelStudent["student_middlename"] . " " . $dataSelStudent["student_lastname"] . ",<br>";
        $message .= "<br><br>Your leave request from ".$dataLeave["from_date"]." to ".$dataLeave["to_date"]." has been approved.<br><br>";
        $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
        $message .= "Thank You.";

        sendEmail($recipientEmail,$subject,$message);
        //Email End

        ?>
          <script>
          alert("Leave Request Accepted");
          </script>
        <?php
  
    }
    if(isset($_GET["rid"]))
    {
        $status=2;
        $leaveRequestUpdateQry="update tbl_leave set leave_status='".$status."' where leave_id='".$_GET["rid"]."'";
        $con->query($leaveRequestUpdateQry);
  
        //Email Start

        $selLeave="select * from tbl_leave where leave_id='".$_GET["rid"]."'";
        $rowLeave=$con->query($selLeave);
        $dataLeave=$rowLeave->fetch_assoc();

        $selStudent="select * from tbl_student s inner join tbl_user u on s.user_id=u.user_id where s.user_id='".$dataLeave['user_id']."'";
        $rowSelStudent=$con->query($selStudent);
        $dataSelStudent=$rowSelStudent->fetch_assoc();

        

        $recipientEmail= $dataSelStudent["user_email"];
        $subject="Leave Rejected";

        $message = "Dear " . $dataSelStudent["student_firstname"] . " " . $dataSelStudent["student_middlename"] . " " . $dataSelStudent["student_lastname"] . ",<br>";
        $message .= "<br><br>Your leave request from ".$dataLeave["from_date"]." to ".$dataLeave["to_date"]." has been rejected.<br><br>";
        $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
        $message .= "Thank You.";

        sendEmail($recipientEmail,$subject,$message);
        //Email End

        ?>
          <script>
          alert("Leave Request Rejected");
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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Leave Requests</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl.No.</th>
        <th>Student</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Reason</th>
        <th>Applied Date</th>
        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
      $selRequest="select * from tbl_leave l inner join tbl_student s on l.user_id=s.user_id";
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["student_firstname"]." ".$data["student_middlename"]." ".$data["student_lastname"]?></td>
          <td><?php echo $data["from_date"]?></td>
          <td><?php echo $data["to_date"]?></td>
          <td><?php echo $data["leave_reason"]?></td>
          <td><?php echo $data["applied_date"]?></td>
          <td>
          <?php if ($data["leave_status"]==0)
                  {
                      ?>
                      <a href="viewLeaveRequest.php?aid=<?php echo $data['leave_id']; ?>" class="badge badge-success" style="font-size:13px;">Accept</a>
                      <a href="viewLeaveRequest.php?rid=<?php echo $data["leave_id"];?>" class="badge badge-danger" style="font-size:13px;">Reject</a>
                      <?php
                  }
                  else if ($data["leave_status"]==1)
                  {
                    ?><div class="badge badge-success" style="font-size:13px;"><?php echo "Accepted"; ?></div><?php
                  }
                  else{
                    ?><div class="badge badge-danger" style="font-size:13px;"><?php echo "Rejected"; ?></div><?php
                  }
                  ?>
          
          </td>
        </tr>
        <?php

      }

    ?>
                                    </tbody>
                                </table>
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
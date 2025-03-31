<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Rooms</title>
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
      $requestedroomid=$_GET["requestedroomid"];
      $roomChangeUpdateQry="update tbl_roomchangerequest set roomchange_status='".$status."' where request_id='".$_GET["aid"]."'";
      //echo $roomChangeUpdateQry;
      $con->query($roomChangeUpdateQry);

      $selroomUpdateQry="select * from tbl_roompreference where user_id='".$_GET["userid"]."'";
      $rowroomUpdateQry=$con->query($selroomUpdateQry);

      if(mysqli_num_rows($rowroomUpdateQry)>0){
        echo $requestedroomid;
        $roomUpdateQry="update tbl_roompreference set room_id='".$requestedroomid."', room_verification_status='".$status."' where user_id='".$_GET["userid"]."'";
        $con->query($roomUpdateQry);
        $roomUpdateQry="update tbl_room set no_of_occupants=no_of_occupants-1 where room_id='".$_GET["roomid"]."'";
        $con->query($roomUpdateQry);
        $roomUpdateQry="update tbl_room set no_of_occupants=no_of_occupants+1 where room_id='".$_GET["requestedroomid"]."'";
        $con->query($roomUpdateQry);
      }
      else{
        echo "Requested".$_GET["requestedroomid"];
        $roomUpdateQry="insert into tbl_roompreference(room_id,user_id,room_verification_status)values('".$_GET["requestedroomid"]."','".$_GET["userid"]."','".$status."')";
        $con->query($roomUpdateQry);
        $roomUpdateQry="update tbl_room set no_of_occupants=no_of_occupants+1 where room_id='".$_GET["requestedroomid"]."'";
        $con->query($roomUpdateQry);
      }

      //Email Start
            $selUser="select * from tbl_user u inner join tbl_student s on u.user_id=s.user_id where u.user_id='".$_GET["userid"]."'";
            $rowSelUser=$con->query($selUser);
            $dataSelUser=$rowSelUser->fetch_assoc();

            
            $selRequestedRoom="select * from tbl_room where room_id='".$_GET["requestedroomid"]."'";
            $rowSelRequestedRoom=$con->query($selRequestedRoom);
            $dataSelRequestedRoom=$rowSelRequestedRoom->fetch_assoc();

            $recipientEmail= $dataSelUser["user_email"];
            $subject="Room Request Accepted";

            $message = "Dear " . $dataSelUser["student_firstname"] . " " . $dataSelUser["student_middlename"] . " " . $dataSelUser["student_lastname"] . ",<br><br>";
            $message .= "Your request for Floor ".$dataSelRequestedRoom["room_floor"]." Room Number ". $dataSelRequestedRoom["room_number"] ." has been accepted.<br><br>";
            $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
            $message .= "Thank You.";

            sendEmail($recipientEmail,$subject,$message);
      //Email End

      ?>
        <script>
        alert("Accepted");
        window.location = "viewRoomChangeRequest.php";
        </script>
      <?php

  }
  if(isset($_GET["rid"]))
  {
      $status=2;
      $roomChangeUpdateQry="update tbl_roomchangerequest set roomchange_status='".$status."' where request_id='".$_GET["rid"]."'";
      $con->query($roomChangeUpdateQry);

      //Email Start
            $selUser="select * from tbl_user u inner join tbl_student s on u.user_id=s.user_id where u.user_id='".$_GET["userid"]."'";
            $rowSelUser=$con->query($selUser);
            $dataSelUser=$rowSelUser->fetch_assoc();

            
            $selRequestedRoom="select * from tbl_room where room_id='".$_GET["requestedroomid"]."'";
            $rowSelRequestedRoom=$con->query($selRequestedRoom);
            $dataSelRequestedRoom=$rowSelRequestedRoom->fetch_assoc();

            $recipientEmail= $dataSelUser["user_email"];
            $subject="Room Request Rejected";

            $message = "Dear " . $dataSelUser["student_firstname"] . " " . $dataSelUser["student_middlename"] . " " . $dataSelUser["student_lastname"] . ",<br><br>";
            $message .= "Your request for Floor ".$dataSelRequestedRoom["room_floor"]." Room Number ". $dataSelRequestedRoom["room_number"] ." has been rejected.<br><br>";
            $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
            $message .= "Thank You.";

            sendEmail($recipientEmail,$subject,$message);
      //Email End

      ?>
        <script>
        alert("Rejected");
        window.location = "viewRoomChangeRequest.php";
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
                                <h4 class="card-title">Room Requests</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl.No.</th>
        <th>Student</th>
        <th>Current Room</th>
        <th>Reason</th>
        <th>Requested Room</th>
        <th>Capacity</th>
        <th>No of Occupants</th>
        <th>Rent</th>
        <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    if(isset($_GET["studentid"]))
    {
      $selRequest="select rcr.room_id as curroomid,rcr.*,r.*,s.* from tbl_roomchangerequest rcr inner join tbl_room r inner join tbl_student s on r.room_id=rcr.requested_room_id and rcr.user_id=s.user_id where rcr.user_id='".$_GET["studentid"]."'";
    }
    else
    {
      $selRequest="select rcr.room_id as curroomid,rcr.*,r.*,s.* from tbl_roomchangerequest rcr inner join tbl_room r inner join tbl_student s on r.room_id=rcr.requested_room_id and rcr.user_id=s.user_id";
    }
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["student_firstname"]." ".$data["student_middlename"]." ".$data["student_lastname"]?></td>
          <?php
          if($data["curroomid"]==0){
            ?>
            <td></td>
            <?php
          }
          else{
            $selCurrentroom="select * from tbl_room where room_id='".$data["curroomid"]."'";
            $rowcurrent=$con->query($selCurrentroom);
            $datacurrent=$rowcurrent->fetch_assoc();
            ?>
            <td><?php echo "Floor ".$datacurrent["room_floor"]." Room Number ".$datacurrent["room_number"]?></td>
            <?php
          }
          
          ?>
          
          <td><?php echo $data["reason"]?></td>
          <td><?php echo "Floor ".$data["room_floor"]." Room Number ".$data["room_number"]?></td>
          <td><?php echo $data["room_capacity"]?></td>
          <td><?php echo $data["no_of_occupants"]?></td>
          <td><?php echo $data["room_rent"]." Rs.";?></td>
          <td><?php if ($data["roomchange_status"]==0)
                {
                  if($data["curroomid"]==0)
                      $curr=0;
                  else
                      $curr=$datacurrent['room_id'];
                    ?> <a href="viewRoomChangeRequest.php?aid=<?php echo $data["request_id"];?>&roomid=<?php echo $curr;?>&requestedroomid=<?php echo $data['requested_room_id'];?>&userid=<?php echo $data["user_id"];?>" class="badge badge-success" style="font-size:13px;">Accept</a>&nbsp;&nbsp;&nbsp;<a href="viewRoomChangeRequest.php?rid=<?php echo $data["request_id"];?>&requestedroomid=<?php echo $data['requested_room_id'];?>&userid=<?php echo $data["user_id"];?>" class="badge badge-danger" style="font-size:13px;">Reject</a> <?php
                }
                else if ($data["roomchange_status"]==1)
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


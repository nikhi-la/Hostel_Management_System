<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student List</title>
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

    if (isset($_GET["nid"])){
        ?>
            <script>
            alert("Payments not completed");
            window.location="removeStudent.php";
            </script>
        <?php
    }
    if (isset($_GET["vid"])){

        ?>
            <script>
            window.location="payBackCD.php";
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
                                <h4 class="card-title" >Student List</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th><center>Photo</center></th>
                                            <th>Proof</th>
                                            <th>Room Preference</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selStudent = "SELECT *  FROM tbl_student s INNER JOIN tbl_user u ON s.user_id = u.user_id inner join tbl_roompreference rp on s.user_id=rp.user_id inner join tbl_room r on rp.room_id=r.room_id where verification_status=1 or verification_status=3 ";
                                        $row = $con->query($selStudent);
                                        while ($data = $row->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $data["user_id"]; ?></td>
                                                <td><?php echo ucfirst($data["student_firstname"]) . " " . ucfirst($data["student_middlename"]) . " " . ucfirst($data["student_lastname"]); ?></td>
                                                <td><?php echo $data["student_dob"]; ?></td>
                                                <td><?php echo ucfirst($data["student_gender"]); ?></td>
                                                <td>
                                                    <p><?php echo ucfirst($data["student_housename"]); ?></p>
                                                    <p><?php echo ucfirst($data["student_city"]); ?></p>
                                                    <p><?php echo ucfirst($data["student_district"]); ?></p>
                                                    <p><?php echo ucfirst($data["student_country"]); ?></p>
                                                    <p><?php echo $data["student_pincode"]; ?></p>
                                                </td>
                                                <td><?php echo $data["user_email"]; ?></td>
                                                <td><?php echo $data["student_contact"]; ?></td>
                                                <td style="padding:0;">
                                                    <center>
                                                        <img src="../Assets/Files/studentPhoto/<?php echo $data["student_photo"]; ?>" style="border-radius:0;width:50%;height:10%;" />
                                                    </center>
                                                </td>
                                                <td>
                                                    <a href="../Assets/Files/studentProof/<?php echo $data["student_proof"]; ?>" download>
                                                        <i class="mdi mdi-download" style="font-size:48px;color:black;"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                <?php echo "Floor ".$data['room_floor']." Number ".$data['room_number']; ?>
                                                </td>
                                                <td>
                                                        <?php
                                                            $sel="select * from tbl_messfee where user_id='".$data['user_id']."' and payment_status=0";
                                                            $rowSel=$con->query($sel);
                                                            if(mysqli_num_rows($rowSel)>0){
                                                                ?><a href="removeStudent.php?nid=<?php echo $data['user_id'];?>" class="badge badge-danger" style="font-size:13px;">Payment Not Completed</a><?php
                                                            }
                                                            else{
                                                                $selStud="select verification_status from tbl_student where user_id='".$data['user_id']."'";
                                                                $rowSelStud=$con->query($selStud);
                                                                $dataSelStud=$rowSelStud->fetch_assoc();
                                                                if($dataSelStud["verification_status"]==3)
                                                                {
                                                                    ?>
                                                                <a href="payBackCD.php?vid=<?php echo $data['user_id'];?>&rid=<?php echo $data['room_id'];?>" class="badge badge-info" style="font-size:13px;">Pay Caution Deposit</a><?php
                                                            
                                                                }
                                                               
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
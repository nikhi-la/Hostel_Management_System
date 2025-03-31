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
    include('../email.php');

    if (isset($_GET["aid"])) {
        $status = 1;
        $updateQry = "UPDATE tbl_student SET verification_status='$status' WHERE user_id='" . $_GET["aid"] . "'";
        $con->query($updateQry);

        if ($con->query($updateQry)) {
            $updateParentQry = "UPDATE tbl_parent SET verification_status='$status' WHERE student_id='" . $_GET["aid"] . "'";
            $con->query($updateParentQry);

            $sel="SELECT * FROM tbl_student s inner join tbl_user u on s.user_id=u.user_id where s.user_id='" . $_GET["aid"] . "'";
            $rowSel = $con->query($sel);
            $dataSel = $rowSel->fetch_assoc();

            //Email Start
            $recipientEmail= $dataSel["user_email"];
            $subject="Application Accepted";

            $message = "Dear " . $dataSel["student_firstname"] . " " . $dataSel["student_middlename"] . " " . $dataSel["student_lastname"] . ",<br>";
            $message .= "Welcome to HMS! Your Application is accepted.<br>";
            $message .= "You can now access all the features.<br><br>Pay the caution deposit bill available in the Fees->Caution Deposit tab.<br><br>";
            $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
            $message .= "Thank You.";

            sendEmail($recipientEmail,$subject,$message);
            //Email End

            $selParent="SELECT * FROM tbl_parent p inner join tbl_user u on p.user_id=u.user_id where student_id='" . $_GET["aid"] . "'";
            $rowSel = $con->query($selParent);
            $dataSel = $rowSel->fetch_assoc();

            //Email Start
            $recipientEmail= $dataSel["user_email"];
            $subject="Application Accepted";

            $message = "Dear " . $dataSel["parent_name"] . ",<br>";
            $message .= "Welcome to HMS! Your Application is accepted.<br>";
            $message .= "You can now access all the features.<br><br>";
            $message .= "Your current password is" .$dataSel["user_password"].".<br>Please login and reset password.<br><br>";
            $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
            $message .= "Thank You.";

            sendEmail($recipientEmail,$subject,$message);
            //Email End

            ?>
            <script>
                alert("Student Accepted");
                window.location = "studentList.php";
            </script>
            <?php
        }
    }

    if (isset($_GET["rid"])) {
        $status = 2;
        $updateQry = "UPDATE tbl_student SET verification_status='$status' WHERE user_id='" . $_GET["rid"] . "'";

        if ($con->query($updateQry)) {
            $updateParentQry = "UPDATE tbl_parent SET verification_status='$status' WHERE student_id='" . $_GET["rid"] . "'";
            $con->query($updateParentQry);

            $sel="SELECT * FROM tbl_student s inner join tbl_user u on s.user_id=u.user_id where s.user_id='" . $_GET["rid"] . "'";
            $rowSel = $con->query($sel);
            $dataSel = $rowSel->fetch_assoc();

            //Email Start
            $recipientEmail= $dataSel["user_email"];
            $subject="Application Rejected";

            $message = "Dear " . $dataSel["student_firstname"] . " " . $dataSel["student_middlename"] . " " . $dataSel["student_lastname"] . ",<br>";
            $message .= "Sorry for the inconvenience! Your Application is rejected.<br>";
            $message .= "<br>Have any query? , feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
            $message .= "Thank You.";

            sendEmail($recipientEmail,$subject,$message);
            //Email End

            $selParent="SELECT * FROM tbl_parent p inner join tbl_user u on p.user_id=u.user_id where student_id='" . $_GET["rid"] . "'";
            $rowSel = $con->query($selParent);
            $dataSel = $rowSel->fetch_assoc();

            //Email Start
            $recipientEmail= $dataSel["user_email"];
            $subject="Application Rejected";

            $message = "Dear " . $dataSel["parent_name"] . ",<br>";
            $message .= "Sorry for the inconvenience! Your Application is rejected.<br>";
            $message .= "<br>Have any query?, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
            $message .= "Thank You.";

            sendEmail($recipientEmail,$subject,$message);
            //Email End

            ?>
            <script>
                alert("Student Rejected");
                window.location = "studentList.php";
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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Student List</h4>
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
                                            <th></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selStudent = "SELECT *  FROM tbl_student s INNER JOIN tbl_user u ON s.user_id = u.user_id where verification_status!=4 order by s.user_id desc";

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
                                                <a href="viewRoomChangeRequest.php?&studentid=<?php echo $data['user_id']; ?>" class="btn btn-link btn-rounded btn-fw" style="font-size: 14px;">View Room Preference</a>
                                                <br>
                                                <a href="viewGuardian.php?&studentid=<?php echo $data['user_id']; ?>" class="btn btn-link btn-rounded btn-fw" style="font-size: 14px;">View Guardian</a>
                                                </td>
                                                <td>
                                                    <?php if ($data["verification_status"] == 0) { ?>
                                                        <a href="studentList.php?aid=<?php echo $data['user_id']; ?>" class="badge badge-success" style="font-size:13px;">Accept</a>
                                                        <a href="studentList.php?rid=<?php echo $data["user_id"]; ?>" class="badge badge-danger" style="font-size:13px;">Reject</a>
                                                    <?php } else if ($data["verification_status"] == 1) { ?>
                                                        <div class="badge badge-success" style="font-size:13px;"><?php echo "Accepted"; ?></div>
                                                    <?php } else if ($data["verification_status"] == 2){ ?>
                                                        <div class="badge badge-danger" style="font-size:13px;"><?php echo "Rejected"; ?></div>
                                                    <?php } else if ($data["verification_status"] == 3) {?>
                                                    <div class="badge badge-info" style="font-size:13px;"><?php echo "Vacated"; ?></div>
                                                    <?php } ?>
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
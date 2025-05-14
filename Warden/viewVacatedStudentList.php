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
     @media print {
    .sidebar, 
    .navbar, 
    .back-button, 
    .front-button, 
    .footer, 
    .btn, 
    .page-footer {
        display: none !important;
    }

    .main-panel {
        margin: 0 !important;
        width: 100% !important;
    }
}
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
                                <h4 class="card-title">Vaccated Student List</h4>
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
                                            <th>Photo</th>
                                            <th>Proof</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $selStudent = "SELECT *  FROM tbl_student s INNER JOIN tbl_user u ON s.user_id = u.user_id  where verification_status=4";
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
                                                        <img src="../Assets/Files/studentPhoto/<?php echo $data["student_photo"]; ?>" style="border-radius:0;width:3cm;height:4cm;" />
                                                    </center>
                                                </td>
                                                <td>
                                                    <a href="../Assets/Files/studentProof/<?php echo $data["student_proof"]; ?>" download>
                                                        <i class="mdi mdi-download" style="font-size:48px;color:black;"></i>
                                                    </a>
                                                </td>
                                                
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Print Button -->
<button class="btn btn-info btn-rounded btn-icon front-button" onclick="printPage()">🖨</button>
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

function printPage() {
    window.print();
}
</script>
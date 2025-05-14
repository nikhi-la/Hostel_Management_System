<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Guardian</title>
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

    .profile-photo {
    width: 100px !important;  /* Adjust width as needed */
    height: 100px !important; /* Ensures a square shape */
    border-radius: 10px; /* Slightly rounded corners for a modern look */
    object-fit: cover; /* Ensures the image fills the square without distortion */
    border: 2px solid #ccc; /* Optional: Light gray border */
    display: block; /* Makes it a block element */
     /* Centers it horizontally */
}
</style>
</head>
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
                                <h4 class="card-title">Guardian List</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl.No.</th>
        <th>Guardian</th>
        <th>Student</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Photo</th>
        <th>Proof</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    
      $selRequest="select * from tbl_parent p inner join tbl_student s on p.student_id=s.user_id inner join tbl_user u on u.user_id=p.user_id where p.verification_status=1";
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["parent_name"]?></td>
          <td><?php echo $data["student_firstname"]." ".$data["student_middlename"]." ".$data["student_lastname"]?></td>
          <td><?php echo $data["parent_contact"]?></td>
          <td><?php echo $data["user_email"]?></td>
          <td style="padding: 5px 0;">
                    <img src="../Assets/Files/ParentPhoto/<?php echo $data["parent_photo"]; ?>" class="profile-photo" />
            </td>
            <td>
                <a href="../Assets/Files/ParentProof/<?php echo $data["parent_proof"]; ?>" download>
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

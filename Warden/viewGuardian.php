<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Expenses</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../Assets/Template/Warden/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../Assets/Template/Warden/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../Assets/Template/Warden/images/Logo.png" />

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
        .profile-photo {
                width: 100px;  /* Adjust size as needed */
                height: 100px; /* Ensure it's a perfect square */
                border-radius: 50%; /* Makes it round */
                object-fit: cover; /* Ensures the image fills the circle properly */
                border: 2px solid #000; /* Optional: Adds a black border */
                margin: auto;
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content tab-transparent-content">
                                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                                    <center>
                                        <div class="col-6 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title" style="font-size: 25px;">Guardian</h4>
                                                        <?php
                                                            $selQry="select * from tbl_parent p inner join tbl_user u on p.user_id=u.user_id where p.student_id='".$_GET["studentid"]."'";
                                                            $row=$con->query($selQry);
                                                            $data=$row->fetch_assoc();
                                                        ?>
                                                        <div class="form-group row">
                                                        <div class="col-sm-12">
                                                        <img src="../Assets/Files/ParentPhoto/<?php echo $data["parent_photo"]; ?>" class="profile-photo" style="text-align: center;" />
                                                    
                                                        </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            
                                                            <label for="name" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;"></label>
                                                            
                                                            <label for="name" class="col-sm-2 col-form-label" style="font-size: 15px;color: black;text-align: left;"><b>Name</b></label>
                                                            <div class="col-sm-7">
                                                            <label for="name" class="col-sm-6 col-form-label" style="font-size: 15px;color: black;text-align: left;"><?php echo $data["parent_name"]  ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            
                                                            <label for="relation" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;"></label>
                                                            
                                                            <label for="relation" class="col-sm-2 col-form-label" style="font-size: 15px;color: black;text-align: left;"><b>Relation</b></label>
                                                            <div class="col-sm-7">
                                                            <label for="relation" class="col-sm-6 col-form-label" style="font-size: 15px;color: black;text-align: left;"><?php echo $data["parent_relation"]  ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            
                                                            <label for="contact" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;"></label>
                                                            
                                                            <label for="contact" class="col-sm-2 col-form-label" style="font-size: 15px;color: black;text-align: left;"><b>Contact</b></label>
                                                            <div class="col-sm-7">
                                                            <label for="contact" class="col-sm-6 col-form-label" style="font-size: 15px;color: black;text-align: left;"><?php echo $data["parent_contact"]  ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            
                                                            <label for="email" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;"></label>
                                                            
                                                            <label for="email" class="col-sm-2 col-form-label" style="font-size: 15px;color: black;text-align: left;"><b>Email</b></label>
                                                            <div class="col-sm-7">
                                                            <label for="email" class="col-sm-6 col-form-label" style="font-size: 15px;color: black;text-align: left;"><?php echo $data["user_email"]  ?></label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            
                                                            <label for="proof" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;"></label>
                                                            
                                                            <label for="proof" class="col-sm-2 col-form-label" style="font-size: 15px;color: black;text-align: left;"><b>Proof</b></label>
                                                            <div class="col-sm-5">
                                                            <a href="../Assets/Files/ParentProof/<?php echo $data["parent_proof"]; ?>" download>
                                                                <i class="mdi mdi-download" style="font-size:48px;color:black;"></i>
                                                            </a>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </center>
                                </div>
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

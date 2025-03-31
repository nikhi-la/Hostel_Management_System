<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Change Password</title>
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

    if(isset($_POST["btnsave"])){
        $sel="select user_password from tbl_user where user_id='".$_SESSION["user_id"]."'";
        $row = $con->query($sel);
        $data = $row->fetch_assoc();

        if($_POST["currpassword"]==$data["user_password"]){

            if($_POST["newpassword"]==$_POST["confirmpassword"]){

                $updateQry="update tbl_user set user_password='".$_POST["newpassword"]."' where user_id='".$_SESSION["user_id"]."'";
                if($con->query($updateQry)){
                    ?>
                    <script>
                        alert("Password Updated");
                        window.location="changePassword.php";
                    </script>
                    <?php
                }
                
            }
            else{
                ?>
                <script>
                    alert("Password Mismatch");
                </script>
                <?php
            }

        }
        else{
            ?>
            <script>
                alert("Current Password Invalid");
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content tab-transparent-content">
                                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                                    <center>
                                        <div class="col-6 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title" style="font-size: 25px;">Change Password</h4>
                                                    <form id="form1" name="form1" class="forms-sample" method="post" action="changePassword.php">
                                                        <div class="form-group row">
                                                            <label for="currpassword" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Current Password</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" name="currpassword" id="currpassword" class="form-control" required="required" autocomplete="off" value="<?php echo ""; ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="newpassword" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">New Password</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" name="newpassword" id="newpassword" class="form-control" required="required" autocomplete="off" value="<?php echo ""; ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="confirmpassword" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Confirm Password</label>
                                                            <div class="col-sm-9">
                                                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" required="required" autocomplete="off" value="<?php echo ""; ?>" />
                                                            </div>
                                                        </div>

                                                       
                                                        <input type="submit" name="btnsave" id="btnsave" class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;" value="Submit" />
                                                        &nbsp;&nbsp;&nbsp;
                                                        <input type="reset" name="btncancel" id="btncancel" class="btn btn-secondary btn-rounded btn-fw" style="font-size: 15px;" value="Cancel" />
                                                    </form>
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
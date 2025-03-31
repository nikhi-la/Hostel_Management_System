<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Room Type</title>
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

    $eid="";
    $share="";
    $type="";
    $rent="";

    if(isset($_GET["eid"])){
        $eid=$_GET["eid"];
        $sel="select * from tbl_roomtype where roomtype_id=$eid";
        $row=$con->query($sel);
        $data=$row->fetch_assoc();

        $share=$data["room_share"];
        $type=$data["room_type"];
        $rent=$data["room_amount"];
    }
    
    if(isset($_POST["btnsave"])){
        
        if(isset($_POST["eid"]) && !empty($_POST["eid"]))
		{
            $updateQry="update tbl_roomtype set room_share='".$_POST["share"]."',room_type='".$_POST["roomtype"]."',room_amount='".$_POST["amount"]."' where roomtype_id=".$_POST["eid"]."";
			if($con->query($updateQry))
				{
					?>
					<script>
					alert("Room Type Updated");
                    window.location="basicLayout.php";
					</script>
	
					<?php	
				}
        }
        else{
            $insQry="insert into tbl_roomtype(room_share,room_type,room_amount)values('".$_POST["share"]."','".$_POST["roomtype"]."','".$_POST["amount"]."')";
            if($con->query($insQry)){
                ?>
                <script>
                alert("Room type added");
                </script>
                <?php
            }
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
                                                    <h4 class="card-title" style="font-size: 25px;">Add Room Type</h4>
                                                    <form id="form1" name="form1" class="forms-sample" method="post" action="addRoomType.php">
                                                        <div class="form-group row">
                                                            <label for="share" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Share</label>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="eid" id="eid" class="form-control" required="required" value="<?php echo $eid; ?>" autocomplete="off" />
                                                                <input type="number" name="share" id="share" class="form-control" required="required" value="<?php echo $share; ?>" autocomplete="off" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="roomtype" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Room Type</label>
                                                            <div class="col-sm-9">
                                                                <select name="roomtype" id="roomtype" class="form-control" required>
                                                                    <option value="" disabled selected>Select</option>
                                                                    <option value="1" <?php if($type == 1) echo 'selected'; ?>>AC</option>
                                                                    <option value="2" <?php if($type == 2) echo 'selected'; ?>>Non-AC</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="amount" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Amount</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="amount" id="amount" class="form-control" required="required" value="<?php echo $rent; ?>" autocomplete="off" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <input type="submit" name="btnsave" id="btnsave" class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;" value="Submit" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input type="reset" name="btncancel" id="btncancel" class="btn btn-secondary btn-rounded btn-fw" style="font-size: 15px;" value="Cancel" />
                                                                
                                                            </div>
                                                        </div>

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
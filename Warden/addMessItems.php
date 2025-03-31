<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Mess</title>
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
	
	$date="";
	$breakfast="";
	$lunch="";
	$teatime="";
	$dinner="";
	$eid="";
	if(isset($_GET["eid"]))
		{
			$selQry="select * from tbl_mess where mess_id='".$_GET["eid"]."'";
			$row=$con->query($selQry);
			$dataedit=$row->fetch_assoc();
	
			$eid=$_GET["eid"];
			$date=$dataedit["mess_date"];
			$breakfast=$dataedit["breakfast"];
			$lunch=$dataedit["lunch"];
			$teatime=$dataedit["tea_time"];
			$dinner=$dataedit["dinner"];
		}
		
	if(isset($_POST["btnsave"]))
	{
		if(isset($_POST["editid"]) && !empty($_POST["editid"]))
		{
			#echo $_POST["editid"];
			$updateQry="update tbl_mess set mess_date='".$_POST["messdate"]."',breakfast='".$_POST["breakfast"]."',lunch='".$_POST["lunch"]."',tea_time='".$_POST["teatime"]."',dinner='".$_POST["dinner"]."' where mess_id=".$_POST["editid"]."";
			if($con->query($updateQry))
				{
					?>
					<script>
					alert("Updated Succesfully");
					</script>
	
					<?php	
				}
			else
				{
					?>
					<script>
					alert("Updation Failed");
					</script>
					<?php
				}
		}
		else
		{
            $selAlreadyExist="select * from tbl_mess where mess_date='".$_POST["messdate"]."'";
            $rowAlreadyExist=$con->query($selAlreadyExist);
            if(mysqli_num_rows($rowAlreadyExist)>0){
                ?>
                <script>
                    alert("Mess Plan Already Exist for the Day");
					window.location="addMessItems.php";
                </script>
                <?php
            }
            else{
                $insMess="insert into tbl_mess(mess_date,breakfast,lunch,tea_time,dinner,veg_status,nonveg_status)values('".$_POST["messdate"]."','".$_POST["breakfast"]."','".$_POST["lunch"]."','".$_POST["teatime"]."','".$_POST["dinner"]."',0,0)";
                #echo $insRoom;
                if($con->query($insMess))
                    {
                        ?>
                        <script>
                        alert("Mess Added");
                        </script>
        
                        <?php	
                    }
                else
                    {
                        ?>
                        <script>
                        alert("Failed");
                        </script>
                        <?php
                    }
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
                                                    <h4 class="card-title" style="font-size: 25px;">Add Mess Details</h4>
                                                    <form id="form1" name="form1" class="forms-sample" method="post" action="addMessItems.php">
                                                        <div class="form-group row">
                                                            <label for="messdate" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Date</label>
                                                            <div class="col-sm-9">
																<input type="hidden" name="editid" id="editid" value="<?php echo $eid?>" />
																<input type="date" name="messdate" id="messdate" class="form-control" required="required" value="<?php echo $date?>" autocomplete="off" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+7 days")); ?>"/>
															</div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="breakfast" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Breakfast</label>
                                                            <div class="col-sm-9">
															<input type="text" name="breakfast" id="breakfast" class="form-control" required="required" value="<?php echo $breakfast?>" autocomplete="off" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="lunch" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Lunch</label>
                                                            <div class="col-sm-9">
															<input type="text" name="lunch" id="lunch" class="form-control" required="required" value="<?php echo $lunch?>" autocomplete="off" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="teatime" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Tea Time</label>
                                                            <div class="col-sm-9">
															<input type="text" name="teatime" id="teatime"  class="form-control" required="required" value="<?php echo $teatime?>" autocomplete="off" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="dinner" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Dinner</label>
                                                            <div class="col-sm-9">
															<input type="text" name="dinner" id="dinner" class="form-control" required="required" value="<?php echo $dinner?>" autocomplete="off" />
                                                            </div>
                                                        </div>
                                                        <input type="submit" name="btnsave" id="btnsave" style="font-size: 15px;" class="btn btn-info btn-rounded btn-fw" value="Save" />
                                                        &nbsp;&nbsp;&nbsp;
                                                        <input type="reset" name="btncancel" id="btncancel" style="font-size: 15px;" class="btn btn-secondary btn-rounded btn-fw" value="Cancel" />
                                                    </form>
                                                    <br><br><br>
                                                    <a href="viewMessItems.php" class="btn btn-link btn-rounded btn-fw" style="font-size: 18px;"> View Mess</a>
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
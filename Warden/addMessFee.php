<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Mess Fee</title>
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
    include('../email.php');

    if(isset($_POST["btnsave"])){

        $month = date("n", strtotime("first day of last month")); // Full month name (e.g., February)
        $year = date("Y", strtotime("-1 month")); // Year of the previous month (e.g., 2024)
        $expense=$_POST["commonexpense"];

        $studentQry = "SELECT * FROM tbl_user u inner join tbl_student s on u.user_id=s.user_id WHERE verification_status = 1";
        $rowStudentQry = $con->query($studentQry);

        while ($dataStudentQry = $rowStudentQry->fetch_assoc()) {

            $userId = $dataStudentQry['user_id'];

            // Step 3: Get number of present days for each student
            $totalattendanceQry = "SELECT COUNT(*) as present_days 
                                FROM tbl_attendance 
                                WHERE attendance_status = 1 
                                AND user_id = '".$userId."' 
                                AND MONTH(attendance_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                                AND YEAR(attendance_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)";
            //echo $totalattendanceQry;
                    
            $totalattendanceResult = $con->query($totalattendanceQry);
            $dataTotalattendanceResult = $totalattendanceResult->fetch_assoc();
            if(mysqli_num_rows($totalattendanceResult)==0)
                    $totalCount=0;
            else
                $totalCount = $dataTotalattendanceResult['present_days']; //count
        
            if($totalCount<=15)
                $messfees=$expense/2;
            else
                $messfees=$expense;

            $insQry="insert into tbl_messfee(month,year,user_id,present_count,mess_fees,added_date,payment_status)values('".$month."','".$year."','".$userId."','".$totalCount."','".$messfees."',curdate(),0)";
            if($con->query($insQry)){

                //Email Start
               
                $recipientEmail= $dataStudentQry['user_email'];
                $subject="Bill Added";

                $message = "Dear " . $dataStudentQry["student_firstname"] . " " . $dataStudentQry["student_middlename"] . " " . $dataStudentQry["student_lastname"] . ",<br><br>";
                $message .= "Bill for ".date("F", mktime(0, 0, 0, $month, 1, date("Y")))." ".$year." has been added.<br><br>";
                $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
                $message .= "Thank You.";

                sendEmail($recipientEmail,$subject,$message);

                //Email End

                //Email Start for parent
                $selParent="select * from tbl_parent p inner join tbl_user u on u.user_id=p.user_id where student_id='".$userId."'";
                $rowSelParent = $con->query($selParent);
                $dataSelParent = $rowSelParent->fetch_assoc();
               
                $recipientEmail= $dataSelParent['user_email'];
                $subject="Bill Added";

                $message = "Dear " . $dataSelParent["parent_name"].",<br><br>";
                $message .= "Bill for ".date("F", mktime(0, 0, 0, $month, 1, date("Y")))." ".$year." has been added.<br><br>";
                $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
                $message .= "Thank You.";

                sendEmail($recipientEmail,$subject,$message);

                //Email End
                
            }

        } 
        ?>
            <script>
            alert("Mess Fee added");
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content tab-transparent-content">
                                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                                    <center>
                                        <div class="col-6 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title" style="font-size: 25px;">Add Mess Fee</h4>
                                                    <form id="form1" name="form1" class="forms-sample" method="post" action="addMessFee.php">
                                                        <div class="form-group row">
                                                            <label for="month" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Month</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="month" id="month" class="form-control" required="required" autocomplete="off" value="<?php echo date("F", strtotime("first day of last month")); ?>" readonly />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="commonexpense" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Mess Expense</label>
                                                            <div class="col-sm-9">
                                                            
                                                            <?php   
                                                            $selMessExpense="select mess_expense from tbl_basic where basic_id=1";
                                                            $rowMessExpense=$con->query($selMessExpense);
                                                            $dataMessExpense=$rowMessExpense->fetch_assoc();
                                                            ?>
                                                                <input type="number" name="commonexpense" id="commonexpense" pattern="[0-9]+" class="form-control" required="required" value="<?php echo $dataMessExpense["mess_expense"] ?>" autocomplete="off" >
                                                            </div>
                                                        
                                                        </div>

                                                        
                                                        <?php
                                                            $selExpense="select * from tbl_messfee mf inner join tbl_student s on mf.user_id=s.user_id where year = year(CURRENT_DATE - INTERVAL 1 MONTH) and month = month(CURRENT_DATE - INTERVAL 1 MONTH) and verification_status!=3 and verification_status!=4";
                                                            $rowExpense=$con->query($selExpense);
                                                            if(mysqli_num_rows($rowExpense)==0)
                                                            {
                                                                ?>
                                                                <input type="submit" name="btnsave" id="btnsave" class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;" value="Submit" />
                                                        &nbsp;&nbsp;&nbsp;
                                                        <input type="reset" name="btncancel" id="btncancel" class="btn btn-secondary btn-rounded btn-fw" style="font-size: 15px;" value="Cancel" />
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                    <div class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;">Mess Fee Added</div>
                                                                <?php
                                                            }
                                                        ?>
                                                        </form>
                                                    <br><br><br>
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
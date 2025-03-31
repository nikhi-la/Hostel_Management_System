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
</head>
<body>

    <?php
    
    include("../Assets/Connection/Connection.php");
    include("SessionValidator.php");

    if(isset($_POST["btnsave"])){

        $month = date("n", strtotime("-1 month")); // Full month name (e.g., February)
        $year = date("Y", strtotime("-1 month")); // Year of the previous month (e.g., 2024)

        if($_POST["totalstudents"]==0)
            $commonper=0;
        else
            $commonper=(float)$_POST["commonexpense"]/$_POST["totalstudents"];
        
        if($_POST["totalvegstudents"]==0)
            $vegper=0;
        else
            $vegper=(float)$_POST["vegexpense"]/$_POST["totalvegstudents"];

        if($_POST["totalnonvegstudents"]==0)
            $nonvegper=0;
        else
            $nonvegper=(float)$_POST["nonvegexpense"]/$_POST["totalnonvegstudents"];

        $insQry="insert into tbl_expense(month,year,common_expense,per_common_expense,veg_expense,per_veg_expense,non_expense,per_non_expense,expense_date)values('".$month."','".$year."','".$_POST["commonexpense"]."','".$commonper."','".$_POST["vegexpense"]."','".$vegper."','".$_POST["nonvegexpense"]."','".$nonvegper."',curdate())";
        if($con->query($insQry)){
            ?>
              <script>
              alert("Expense added");
              </script>
            <?php

            #Assigning to all students

            $studentQry = "SELECT user_id FROM tbl_student WHERE verification_status = 1";
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
            
                // Step 4: Calculate the mess bill
                $commonexpense = $totalCount * $commonper;

                $vegAttendanceQry="SELECT COUNT(*) as present_days FROM tbl_attendance a 
                    INNER JOIN tbl_mess m ON a.attendance_date = m.mess_date 
                    INNER JOIN tbl_messpreference mp ON m.mess_id = mp.mess_id 
                    WHERE a.user_id = '".$userId."' 
                    AND a.attendance_status = 1 
                    AND YEAR(a.attendance_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
                    AND MONTH(a.attendance_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
                    AND mp.preference_status = 1";

                    $vegAttendanceResult = $con->query($vegAttendanceQry);
                    $dataVegAttendanceResult = $vegAttendanceResult->fetch_assoc();
                    if(mysqli_num_rows($vegAttendanceResult)==0)
                        $vegCount=0;
                    else
                        $vegCount = $dataVegAttendanceResult['present_days']; //count
                
                    // Step 4: Calculate the mess bill
                    $vegexpense = $vegCount * $vegper;


                    $nonVegAttendanceQry="SELECT COUNT(*) as present_days FROM tbl_attendance a 
                    INNER JOIN tbl_mess m ON a.attendance_date = m.mess_date 
                    INNER JOIN tbl_messpreference mp ON m.mess_id = mp.mess_id 
                    WHERE a.user_id = '".$userId."' 
                    AND a.attendance_status = 1 
                    AND YEAR(a.attendance_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
                    AND MONTH(a.attendance_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
                    AND mp.preference_status = 2";

                    $nonVegAttendanceResult = $con->query($nonVegAttendanceQry);
                    $dataNonVegAttendanceResult = $nonVegAttendanceResult->fetch_assoc();
                    if(mysqli_num_rows($nonVegAttendanceResult)==0)
                        $nonVegCount=0;
                    else
                        $nonVegCount = $dataNonVegAttendanceResult['present_days']; //count
                
                    // Step 4: Calculate the mess bill
                    $nonvegexpense = $nonVegCount * $nonvegper;
                   
                    $insMessPayment="insert into tbl_messpayment(user_id,month,year,common_days,common_expense,veg_days,veg_expense,nonveg_days,nonveg_expense,payment_status)values
                                                                ('".$userId."','".$month."','".$year."','".$totalCount."','".$commonexpense."','".$vegCount."','".$vegexpense."','".$nonVegCount."','".$nonvegexpense."',0)";
                    $con->query($insMessPayment);
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
                                                    <h4 class="card-title" style="font-size: 25px;">Add Expenses</h4>
                                                    <form id="form1" name="form1" class="forms-sample" method="post" action="addExpenses.php">
                                                        <div class="form-group row">
                                                            <label for="month" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Month</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="month" id="month" class="form-control" required="required" autocomplete="off" value="<?php echo date("F", strtotime("-1 month")); ?>" readonly />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="commonexpense" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Common Expense</label>
                                                            <div class="col-sm-3">
                                                                <input type="number" name="commonexpense" id="commonexpense" class="form-control" required="required" autocomplete="off" >
                                                            </div>
                                                        
                                                            <label for="totalstudents" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Total</label>
                                                            <div class="col-sm-3">

                                                            <?php
                  
                                                            $selQry="select * from tbl_attendance where attendance_status=1 and year(attendance_date) = year(CURRENT_DATE - INTERVAL 1 MONTH) and month(attendance_date) = month(CURRENT_DATE - INTERVAL 1 MONTH)"; 
                                                            $row=$con->query($selQry);
                                                            $count=mysqli_num_rows($row);
                                                            ?>
                                                                <input type="number" name="totalstudents" id="totalstudents" class="form-control" required="required" autocomplete="off" value="<?php echo $count; ?>" readonly >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="vegexpense" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Veg Expense</label>
                                                            <div class="col-sm-3">
                                                                <input type="number" name="vegexpense" id="vegexpense" class="form-control" required="required" autocomplete="off" />
                                                            </div>
                                                            <label for="totalvegstudents" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Veg</label>
                                                            <div class="col-sm-3">
                                                            <?php
                  
                                                                $selQry="select * from tbl_attendance a inner join tbl_mess m inner join tbl_messpreference mp on a.attendance_date=m.mess_date and m.mess_id=mp.mess_id where attendance_status=1 and year(attendance_date) = year(CURRENT_DATE - INTERVAL 1 MONTH) and month(attendance_date) = month(CURRENT_DATE - INTERVAL 1 MONTH) and mp.preference_status=1"; 
                                                                $row=$con->query($selQry);
                                                                $count=mysqli_num_rows($row);
                                                                
                                                                ?>
                                                                <input type="number" name="totalvegstudents" id="totalvegstudents" class="form-control" required="required" autocomplete="off" value="<?php echo $count;  ?>" readonly >
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label for="nonvegexpense" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Non Veg Expense</label>
                                                            <div class="col-sm-3">
                                                                <input type="number" name="nonvegexpense" id="nonvegexpense" class="form-control" required="required" autocomplete="off" value="<?php echo $occupants; ?>" />
                                                            </div>
                                                            <label for="totalnonvegstudents" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Non Veg</label>
                                                            <div class="col-sm-3">
                                                            <?php
                                                                $selQry="select * from tbl_attendance a inner join tbl_mess m inner join tbl_messpreference mp on a.attendance_date=m.mess_date and m.mess_id=mp.mess_id where attendance_status=1 and year(attendance_date) = year(CURRENT_DATE - INTERVAL 1 MONTH) and month(attendance_date) = month(CURRENT_DATE - INTERVAL 1 MONTH) and mp.preference_status=2"; 
                                                                $row=$con->query($selQry);
                                                                $count=mysqli_num_rows($row);
                                                                 ?>
                                                                <input type="number" name="totalnonvegstudents" id="totalnonvegstudents" class="form-control" required="required" autocomplete="off" value="<?php echo $count; ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $selExpense="select * from tbl_expense where year = year(CURRENT_DATE - INTERVAL 1 MONTH) and month = month(CURRENT_DATE - INTERVAL 1 MONTH)";
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
                                                                    <div class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;">Expense Added</div>
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
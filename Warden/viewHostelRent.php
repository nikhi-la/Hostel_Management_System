<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hostel Rent</title>
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
                                <h4 class="card-title">Hostel Rent for <?php echo date("F", strtotime("first day of last month"))." ".date("Y", strtotime("-1 month")); ?></h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl.No.</th>
        <th>Student</th>
        <th>Room Share</th>
        <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
      $selRequest="select * from tbl_roompreference rp inner join tbl_room r on rp.room_id=r.room_id inner join tbl_student s on rp.user_id=s.user_id where verification_status = 1";
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["student_firstname"]." ".$data["student_middlename"]." ".$data["student_lastname"]?></td>
          <td><?php echo $data["room_capacity"]." Share"?></td>
          <td><?php echo $data["room_rent"]." Rs."?></td>
        </tr>
        <?php
        
        if(isset($_POST["btnsave"])){
            $month=date("n", strtotime("first day of last month"));
            $year=date("Y", strtotime("-1 month"));
            $insQry="insert into tbl_hostelrentpayment(user_id,hostelrent_month,hostelrent_year,room_share,room_rent,payment_status)values('".$data["user_id"]."','".$month."','".$year."','".$data["room_capacity"]."','".$data["room_rent"]."',0)";
            $con->query($insQry);
        }
                                                        
      }
    ?>
                                    </tbody>
                                </table>
                                <?php
                                    $selQry="select * from tbl_hostelrentpayment hp inner join tbl_student s on hp.user_id=s.user_id where hostelrent_year = year(CURRENT_DATE - INTERVAL 1 MONTH) and hostelrent_month = month(CURRENT_DATE - INTERVAL 1 MONTH) and verification_status!=3 and verification_status!=4";
                                    $row=$con->query($selQry);
                                    if(mysqli_num_rows($row)==0){
                                        ?>
                                            <center>
                                    <br><br><br>
                                <form id="form1" name="form1" class="forms-sample" method="post" action="viewHostelRent.php">
    <input type="submit" name="btnsave" id="btnsave" class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;" value="Assign Bill" />
    &nbsp;&nbsp;&nbsp;
    </form>
    </center>
                                        <?php
                                    }
                                    else{
                                        ?><center>
                                            <br><br><br>
                                            <div class="btn btn-success btn-rounded btn-fw" style="font-size: 15px;"><?php echo "Bill Assigned" ?></div>
                                    </center>
                                        <?php
                                    }
                                ?>
                                
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
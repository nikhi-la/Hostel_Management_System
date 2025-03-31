<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Payments</title>
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
                                <h4 class="card-title">Payments</h4>
                                
                                <form id="form1" name="form1" method="post" action="">

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                    <th  style="text-align: right;">Month<br><br><br><br><br><br></th>
                                    <th  style="text-align: right;">
                                        <select id="month" name="month">
                                        <option value="0">----Select----</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <br><br><br><br><br><br></th>
                                    <th style="text-align: right;">Year<br><br><br><br><br><br></th>
                                    <th style="text-align: right;"><select name="year" id="year"></select><br><br><br><br><br><br></th>
                                    <th  style="text-align: right;"><input type="submit" name="butSearch" id="butSearch" value="Search" style="font-size: 15px;" class="btn btn-info btn-rounded btn-fw" />
                                    <br><br><br><br><br><br></th>
                                    <th></th>
                                    <th></th>
                                    </tr>
                                        <tr>
                                        <th>Sl.No.</th>
                                        <th>Student</th>
                                        <th>Month/Year</th>
                                        <th>Mess Bill</th>
                                        <th>Room Rent</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    if(isset($_POST["butSearch"])){
        $selRequest="select * from tbl_messpayment mp inner join tbl_hostelrentpayment hp on mp.user_id=hp.user_id inner join tbl_student s on s.user_id=mp.user_id and mp.month=hp.hostelrent_month and mp.year=hp.hostelrent_year where mp.month='".$_POST["month"]."' and mp.year='".$_POST["year"]."' order by year desc,month asc,student_firstname asc";
    }
    else{
      $selRequest="select mp.*,hp.*,s.*,mp.payment_status AS mess_payment_status,hp.payment_status AS hostel_payment_status from tbl_messpayment mp inner join tbl_hostelrentpayment hp on mp.user_id=hp.user_id inner join tbl_student s on s.user_id=mp.user_id and mp.month=hp.hostelrent_month and mp.year=hp.hostelrent_year order by year desc,month asc,student_firstname asc";
    }
    $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["student_firstname"]." ".$data["student_middlename"]." ".$data["student_lastname"]?></td>
          <td><?php echo date("F", mktime(0, 0, 0, $data["month"], 1))." ".$data["year"];?></td>
          <td><?php echo $data["common_expense"]+$data["veg_expense"]+$data["nonveg_expense"]." Rs." ; ?></td>
          <td><?php echo $data["room_rent"]." Rs." ?></td>
          <td><?php echo $data["due_amount"]." Rs." ?></td>
            <td><?php
            if($data["mess_payment_status"]==0 || $data["hostel_payment_status"]==0) 
                echo "Not Paid";
            else
                echo "Paid";?>
            </td>
        </tr>
        <?php
                                                        
      }
    ?>
                                    </tbody>
                                </table> 
                                </form>                           
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
    const yearDropdown = document.getElementById("year");
    const currentYear = new Date().getFullYear();

    for (let y = currentYear; y >= currentYear - 100; y--) {
        let option = document.createElement("option");
        option.value = y;
        option.textContent = y;
        year.appendChild(option);
    }

function goBack() {
    window.history.back();
}

</script>
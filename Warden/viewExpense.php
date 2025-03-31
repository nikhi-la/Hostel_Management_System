<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Movement Log</title>
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
                                <h4 class="card-title">Movemet Log</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl.No.</th>
        <th>Month/Year</th>
        <th>Common Expense</th>
        <th>Common Expense (One Day)</th>
        <th>Veg Expense</th>
        <th>Veg Expense (One Day)</th>
        <th>Non Veg Expense</th>
        <th>Non Veg Expense (One Day)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
      $selRequest="select * from tbl_expense order by year desc,month desc";
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo date('F', mktime(0, 0, 0, $data["month"], 1))." ".$data["year"]; ?></td>
          <td><?php echo $data["common_expense"]." Rs."?></td>
          <td><?php echo $data["per_common_expense"]." Rs."?></td>
          <td><?php echo $data["veg_expense"]." Rs."?></td>
          <td><?php echo $data["per_veg_expense"]." Rs."?></td>
          <td><?php echo $data["non_expense"]." Rs."?></td>
          <td><?php echo $data["per_non_expense"]." Rs."?></td>
       
        </tr>
        <?php

      }

    ?>
                                    </tbody>
                                </table>
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
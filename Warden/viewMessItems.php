<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Mess</title>
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
    if(isset($_GET["did"]))
    {
        $delQry="delete from tbl_mess  where mess_id='".$_GET["did"]."'";
        $con->query($delQry);
  
        ?>
          <script>
          alert("Mess Deleted");
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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">View Mess</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl.No.</th>
        <th>Date</th>
        <th>Breakfast</th>
        <th>Lunch</th>
        <th>Tea Time</th>
        <th>Dinner</th>
        <th>Veg</th>
        <th>Non-Veg</th>
        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
      $selRequest="select * from tbl_mess where mess_date>=curdate()";
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["mess_date"]?></td>
          <td><?php echo $data["breakfast"]?></td>
          <td><?php echo $data["lunch"]?></td>
          <td><?php echo $data["tea_time"]?></td>
          <td><?php echo $data["dinner"]?></td>
          <td><?php echo $data["veg_status"]?></td>
          <td><?php echo $data["nonveg_status"]?></td>
         <td> <a href="viewMessItems.php?did=<?php echo $data['mess_id']; ?>" title="Delete" style="text-decoration: none;">
            <i class="fa fa-trash-o" style="font-size:24px; color: red;"></i></a>
            <a href="addMessItems.php?eid=<?php echo $data['mess_id']; ?>" title="Edit"style="margin-left: 15px; text-decoration: none;">
                <i class="fa fa-edit" style="font-size:24px; color: blue;"></i></a>
        </td>
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
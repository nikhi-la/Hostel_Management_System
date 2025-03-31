<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Basic</title>
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
  th{
    color:#212529;
    font-size:20px;
  }
  td{
    color:#212529;
    font-size:18px;
  }
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
</style>
<body>

    <?php
    include("../Assets/Connection/Connection.php");
    include("SessionValidator.php");

    $sel = "select * from tbl_basic where basic_id=1";
    $row=$con->query($sel);
    $data=$row->fetch_assoc();

    if(isset($_POST["saveFloorCount"])){
      $updateFloorCount="update tbl_basic set floor_count='".$_POST["floorcount"]."' where basic_id=1";
      $con->query($updateFloorCount);
      ?>
        <script>
          alert("Floor Updated");
          window.location="basicLayout.php";
        </script>
      <?php
    }

    if(isset($_POST["saveMessExpense"])){
      $updateMessExpense="update tbl_basic set mess_expense='".$_POST["messexpense"]."' where basic_id=1";
      $con->query($updateMessExpense);
      ?>
        <script>
          alert("Mess Expense Updated");
          window.location="basicLayout.php";
        </script>
      <?php
    }

    if(isset($_GET["did"])){
      $deleteRoomType="delete from tbl_roomtype where roomtype_id='".$_GET["did"]."'";
      $con->query($deleteRoomType);
      ?>
        <script>
          alert("Room Type Deleted");
          window.location="basicLayout.php";
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
            
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Basic Details</h2>
            </div>
            <form method="post" action="basicLayout.php">
            <div class="row">
              <div class="col-md-12">
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Floor Count</h2><br>
                            <?php
                            if(isset($_GET["countid"])){
                      
                              ?><input type="number" name="floorcount" id="floorcount" class="form-control" value="<?php echo $data["floor_count"] ?>" autocomplete="off"  /><br>
                              <input type="submit" name="saveFloorCount" id="saveFloorCount" class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;" value="Save" />                                  
                              <?php

                            }
                            else{
                              ?>
                              <h3 style="color:black;">
                              <?php echo $data["floor_count"] ?><br><br></h3>
                            <a href="basicLayout.php?countid=<?php echo 1; ?>" title="Edit"
                                                    style="margin-left: 5px; text-decoration: none;">
                                                    <i class="fa fa-edit" style="font-size:24px; color: blue;"></i>
                                                </a>
                              <?php
                            }
                            ?>

                            
                            
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Mess Expense</h2><br>
                            <?php
                            if(isset($_GET["messid"])){
                      
                              ?><input type="number" name="messexpense" id="messexpense" class="form-control" value="<?php echo $data["mess_expense"] ?>" autocomplete="off"  /><br>
                              <input type="submit" name="saveMessExpense" id="saveMessExpense" class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;" value="Save" />                                  
                              <?php

                            }
                            else{
                              ?>
                              <h3 style="color:black;">
                              <?php echo $data["mess_expense"]." Rs." ?><br><br></h3>
                            <a href="basicLayout.php?messid=<?php echo 1; ?>" title="Edit"
                                                    style="margin-left: 5px; text-decoration: none;">
                                                    <i class="fa fa-edit" style="font-size:24px; color: blue;"></i>
                                                </a>
                              <?php
                            }
                            ?>

                            
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-6 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Room Type</h2><br>
                            <?php
                              $selRoom="select * from tbl_roomtype";
                              $rowSelRoom=$con->query($selRoom);
                              if(mysqli_num_rows($rowSelRoom)==0){
                                ?><h3 class="mb-0 font-weight-bold mt-2 text-dark d-flex align-items-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  No Room Types Added</h3><?php 
                              }
                              else{
                                ?>
                                <table border="0" width="700px" cellpadding="10">
                                  <tr>
                                      <th>Share</th>
                                      <th>Room Type</th>
                                      <th>Rent</th>
                                      <th></th>
                                  </tr>
                                  
                                <?php
                                while($dataSelRoom=$rowSelRoom->fetch_assoc()){
                                  ?>
                                  <tr>
                                    <td><?php echo $dataSelRoom["room_share"]." Share" ?> </td>
                                    <td><?php 
                                    if($dataSelRoom["room_type"]==1){
                                      echo "AC";
                                    }
                                    else{
                                      echo  "Non AC";
                                    }
                                    ?></td>
                                    <td><?php echo $dataSelRoom["room_amount"]." Rs." ?></td>

                                    <td><a href="basicLayout.php?did=<?php echo $dataSelRoom['roomtype_id']; ?>" title="Delete" style="text-decoration: none;">
                                        <i class="fa fa-trash-o" style="font-size:24px; color: red;"></i></a>
                                        <a href="addRoomType.php?eid=<?php echo $dataSelRoom['roomtype_id']; ?>" title="Edit" style="margin-left: 15px; text-decoration: none;">
                                        <i class="fa fa-edit" style="font-size:24px; color: blue;"></i> <a>
                                      </td>
                                  </tr>
                                  <?php
                                }
                                ?>
                                </table>                                   
                                <?php
                              }
                            ?>
                            
                          </div>
                        </div>
                      </div>
                      
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>          
        </div>
        <!-- Back Button -->
        <button class="btn btn-dark btn-rounded btn-icon back-button" onclick="goBack()">⬅</button>
    
      </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>
<script>
function goBack() {
    if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
    }
    window.history.back();
}
</script>
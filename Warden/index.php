<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HMS</title>
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

h2{
  font-size: 26px;
}
h3{
  font-size: 24px;
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
            
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Overview dashboard </h2>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Total Students</h2><br><br>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select count(*) as snumber from tbl_student where verification_status=1 or verification_status=3";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                echo $data["snumber"];
                            ?>    

                            </h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                          <?php
                                $selQry="select count(*) as rnumber from tbl_room";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                            ?>
                            <h2 class="mb-4 text-dark font-weight-bold">Total Rooms : <?php echo $data["rnumber"]; ?></h2>
                           
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select sum(no_of_occupants) as allocated from tbl_room";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                echo "Allocated : ".$data["allocated"]."<br>";
                            ?>
                            </h3><br>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select count(*)-sum(no_of_occupants) as vacant from tbl_room";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                echo "Vacant : ".$data["vacant"];
                            ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Veg Count</h2>
                            <br><br>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select veg_status as vnumber from tbl_mess where mess_date=curdate()";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                if(mysqli_num_rows($row)==0)
                                    echo "Mess Not Added";
                                else
                                    echo $data["vnumber"];
                            ?>  

                            </h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Non Veg Count</h2>
                            <br><br>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select nonveg_status as vnumber from tbl_mess where mess_date=curdate()";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                if(mysqli_num_rows($row)==0)
                                    echo "Mess Not Added";
                                else
                                    echo $data["vnumber"];
                            ?>
                            </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Attendance Today</h2><br>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select count(*) as pnumber from tbl_attendance where attendance_date=curdate() and attendance_status=1";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                $present=$data["pnumber"];
                                if(mysqli_num_rows($row)==0)
                                    echo "Attendance Not Added";
                                else
                                    echo "Present : ".$data["pnumber"]."<br><br>";

                                $selQry="select count(*) as anumber from tbl_attendance where attendance_date=curdate() and attendance_status=0";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                $absent=$data["anumber"];
                                if(mysqli_num_rows($row)==0)
                                    echo "Attendance Not Added";
                                else
                                    echo "Absent : ".$data["anumber"]."<br><br>";

                                if($present==0 && $absent==0)
                                    echo "Attendance Not Marked";
                            ?>    

                            </h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">New Student</h2>
                           <br><br>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select count(*) as snumber from tbl_student where verification_status=0";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                if($data["snumber"]==0)
                                    echo "No New Student";
                                else  
                                {  
                                    ?><div style="color:red;"> <?php echo $data["snumber"]." New Student";?></div>
                            <?php 
                                }
                            ?> 
                            </h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Room Change Request</h2>
                            <br>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select * from tbl_roomchangerequest where roomchange_status=0";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                if(mysqli_num_rows($row)==0)
                                    echo "No Requests";
                                else
                                {  
                                    ?><div style="color:red;"> <?php echo mysqli_num_rows($row)." New Request";?></div>
                            <?php 
                                }
                            ?> 
                               

                            </h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h2 class="mb-4 text-dark font-weight-bold">Leave Request</h2>
                            <br><br>
                            <h3 class="mb-0 font-weight-bold mt-2 text-dark">
                            <?php
                                $selQry="select * from tbl_leave where leave_status=0";
                                $row=$con->query($selQry);
                                $data=$row->fetch_assoc();
                                if(mysqli_num_rows($row)==0)
                                    echo "No Leave Request";
                                else
                                {  
                                    ?><div style="color:red;"> <?php echo mysqli_num_rows($row)." New Request";?></div>
                            <?php 
                                }
                            ?>
                            </h3>
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
   
    window.history.back();
}

</script>

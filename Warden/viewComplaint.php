<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Complaints</title>
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
    
    if(isset($_POST["btnAccept"]))
    {
        $acceptUpdateQry="update tbl_complaint set complaint_reply='".$_POST["complaintreply"]."',reply_date=curdate(),complaint_status=1 where complaint_id='".$_POST["aid"]."'";
        $con->query($acceptUpdateQry);
  
        ?>
          <script>
          alert("Complaint Accepted");
          </script>
        <?php
  
    }
    if(isset($_GET["sid"]))
    {
        $solveUpdateQry="update tbl_complaint set complaint_status=2 where complaint_id='".$_GET["sid"]."'";
        $con->query($solveUpdateQry);
  
        ?>
          <script>
          alert("Complaint Solved");
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
                                <h4 class="card-title">Complaint</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>Sl.No.</th>
        <th>Student</th>
        <th>Complaint</th>
        <th>Applied Date</th>
        <th>Reply</th>
        <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
      $selRequest="select * from tbl_complaint c inner join tbl_student s on c.user_id=s.user_id";
      $row=$con->query($selRequest);
      $i=0;
      while($data=$row->fetch_assoc())
      {
        $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $data["student_firstname"]." ".$data["student_middlename"]." ".$data["student_lastname"]?></td>
          <td><?php echo $data["complaint"]?></td>
          <td><?php echo $data["complaint_date"]?></td>
          <td>
            <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                <?php
                    if($data["complaint_status"]==0)
                    {
                ?>
            <div class="col-md-8">
                  <textarea name="complaintreply" id="complaintreply" autocomplete="off" class="form-control" rows="5" required ></textarea>
                </div>
                <?php
                }else{
                    echo $data["complaint_reply"];
                }
                ?>
          </td>
          <td>
          <?php if ($data["complaint_status"]==0)
                {
              ?>
            <input type="hidden" name="aid" value="<?php echo $data['complaint_id']; ?>">
            <button type="submit" name="btnAccept" class="badge badge-success" style="font-size: 13px;">
                Mark Accept
            </button>
            <?php
                }
                else if($data["complaint_status"]==1 )
                {
                    ?>
                  <a href="viewComplaint.php?sid=<?php echo $data['complaint_id']; ?>" class="badge badge-info" style="font-size:13px;">Mark Solved</a>
                      <?php
                      }
                else{
                    ?><p style="color:green;"><b><?php echo "Solved";?></b></p>
                    <?php
                }
                ?>
        </td>
          </form>
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
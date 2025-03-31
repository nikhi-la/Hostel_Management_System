<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Rooms</title>
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

    $sel="select * from tbl_basic where basic_id=1";
    $rowSel=$con->query($sel);
    $dataSel=$rowSel->fetch_assoc();

    if (isset($_GET["did"])) {
        $delQry = "delete from tbl_room where room_id=" . $_GET["did"] . "";
        $con->query($delQry);
        ?>
        <script>
            alert("Data deleted");
            window.location = "viewRoomDetails.php";
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
                    <center>
                        <h4 class="card-title text-dark" style="font-size: 30px;">View Rooms</h4>
                    </center>
                    <br><br>

                    <form id="form1" name="form1" method="post" action="viewRoomDetails.php">

                        <?php
                        for ($j = 1; $j <= $dataSel["floor_count"]; ++$j) {
                            $selQry = "select * from tbl_room where room_floor=$j order by room_number";
                            $row = $con->query($selQry);
                            ?>
                            <button class="btn btn-secondary btn-rounded btn-fw" style="font-size:15px;">
                                <?php echo "Floor " . $j ?>
                            </button>
                            <div class="row">
                                <?php
                                while ($data = $row->fetch_assoc()) {
                                    ?>
                                    <div class="col-md-2 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body" style="height:180px;width:400px;">
                                                <p class="text-dark" style="font-size:17px;">
                                                    <?php
                                                    if($data['room_type']==1){$type="AC";}
                                                    else if($data['room_type']==2){$type="Non AC";}
                                                    else{$type="NA";}
                                                    echo "Room Number: " . $data['room_number'] . "<br>" .
                                                        "Type: " . $type . "<br>" .
                                                        "Capacity: " . $data['room_capacity'] . "<br>" .
                                                        "Occupants: " . $data['no_of_occupants'] . "<br>" .
                                                        "Rent: " . $data['room_rent']." Rs."; ?>
                                                </p>
                                            </div>
                                            <br>
                                            <div style="text-align: center; margin-top: -30px;">
                                                <a href="viewRoomDetails.php?did=<?php echo $data['room_id']; ?>" title="Delete"
                                                    style="text-decoration: none;">
                                                    <i class="fa fa-trash-o" style="font-size:24px; color: red;"></i>
                                                </a>
                                                <a href="addRoomDetails.php?eid=<?php echo $data['room_id']; ?>" title="Edit"
                                                    style="margin-left: 15px; text-decoration: none;">
                                                    <i class="fa fa-edit" style="font-size:24px; color: blue;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            echo "<br>";
                        }
                        ?>
                    </form>
                    <!-- Back Button -->
                    <button class="btn btn-dark btn-rounded btn-icon back-button" onclick="goBack()">⬅</button>
                        
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
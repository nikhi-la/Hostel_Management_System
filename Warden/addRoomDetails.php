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

    $floor = "";
    $number = "";
    $capacity = "";
    $occupants = "";
    $rent = "";
    $eid = "";
    $type="";
    if (isset($_GET["eid"])) {
        $selQry = "select * from tbl_room where room_id='" . $_GET["eid"] . "'";
        $row = $con->query($selQry);
        $dataedit = $row->fetch_assoc();

        $eid = $_GET["eid"];
        $floor = $dataedit["room_floor"];
        $number = $dataedit["room_number"];
        $capacity = $dataedit["room_capacity"];
        $occupants = $dataedit["no_of_occupants"];
        $rent = $dataedit["room_rent"];
        $type= $dataedit["room_type"];
    }

    if (isset($_POST["btnsave"])) {
        if (isset($_POST["editid"]) && !empty($_POST["editid"])) {
            $updateQry = "update tbl_room set room_floor='" . $_POST["floor"] . "',room_number='" . $_POST["roomnumber"] . "',room_type='".$_POST["roomtype"]."',room_capacity='" . $_POST["roomcapacity"] . "',no_of_occupants='" . $_POST["occupants"] . "',room_rent='" . $_POST["rent"] . "' where room_id=" . $_POST["editid"] . "";
            if ($con->query($updateQry)) {
                ?>
                <script>
                    alert("Updated Successfully");
					window.location="viewRoomDetails.php";
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Updation Failed");
					window.location="viewRoomDetails.php";
                </script>
                <?php
            }
        } else {

            $selAlreadyExist="select * from tbl_room where room_floor='" . $_POST["floor"] . "' and room_number='" . $_POST["roomnumber"] . "'";
            $rowAlreadyExist=$con->query($selAlreadyExist);
            if(mysqli_num_rows($rowAlreadyExist)>0){
                ?>
                <script>
                    alert("Room Already Exist");
					window.location="addRoomDetails.php";
                </script>
                <?php
            }
            else{
                $sel="select * from tbl_basic where basic_id=1";
                $rowSel=$con->query($sel);
                $dataSel=$rowSel->fetch_assoc();
                if($_POST["floor"]<1 || $_POST["floor"]>$dataSel["floor_count"]){
                    ?>
                    <script>
                        alert("Floor Not Exist");
                        window.location="addRoomDetails.php";
                    </script>
                    <?php
                }
                else{
                    $insRoom = "insert into tbl_room(room_floor,room_number,room_type,room_capacity,no_of_occupants,room_rent)values('" . $_POST["floor"] . "','" . $_POST["roomnumber"] . "','".$_POST["roomtype"]."','" . $_POST["roomcapacity"] . "','" . $_POST["occupants"] . "','" . $_POST["rent"] . "')";
                    if ($con->query($insRoom)) {
                        ?>
                        <script>
                            alert("Data Inserted");
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            alert("Failed");
                        </script>
                        <?php
                    }
                }
                
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
                                                    <h4 class="card-title" style="font-size: 25px;">Add Room Details</h4>
                                                    <form id="form1" name="form1" class="forms-sample" method="post" action="addRoomDetails.php">
                                                        <div class="form-group row">
                                                            <label for="floor" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Floor</label>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="editid" id="editid" value="<?php echo $eid ?>" />
                                                                <input type="number" name="floor" id="floor" class="form-control" required="required" pattern="[0-9]+" autocomplete="off" value="<?php echo $floor; ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="roomnumber" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Room Number</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="roomnumber" id="roomnumber" pattern="[0-9]+" class="form-control" required="required" autocomplete="off" value="<?php echo $number; ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="roomtype" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Room Type</label>
                                                            <div class="col-sm-9">
                                                                <select name="roomtype" id="roomtype" class="form-control" required>
                                                                    <option value="" disabled selected>Select</option>
                                                                    <option value="1" <?php if($type == 1) echo 'selected'; ?>>AC</option>
                                                                    <option value="2" <?php if($type == 2) echo 'selected'; ?>>Non-AC</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="roomcapacity" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Capacity</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="roomcapacity" pattern="[0-9]+" id="roomcapacity" class="form-control" required="required" autocomplete="off" value="<?php echo $capacity; ?>" />
                                                            </div>
                                                        </div>

                                                        
                                                            <?php
                                                            if (isset($_GET["eid"])){
                                                                ?>
                                                                <div class="form-group row">
                                                                    <label for="occupants" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Occupants</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="number" name="occupants" id="occupants" pattern="[0-9]+" class="form-control" required="required" autocomplete="off" value="<?php echo $occupants; ?>" />
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                            else{
                                                                ?>
                                                                    <input type="hidden" name="occupants" id="occupants" pattern="[0-9]+" class="form-control" required="required" autocomplete="off" value=0 readonly />
                                                                <?php
                                                            }
                                                            ?>
                                                               

                                                        <div class="form-group row">
                                                            <label for="rent" class="col-sm-3 col-form-label" style="font-size: 15px;color: black;text-align: left;">Rent</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="rent" id="rent" class="form-control" pattern="[0-9]+" required="required" autocomplete="off" readonly value="<?php echo $rent; ?>" />
                                                            </div>
                                                        </div>

                                                        <input type="submit" name="btnsave" id="btnsave" class="btn btn-info btn-rounded btn-fw" style="font-size: 15px;" value="Submit" />
                                                        &nbsp;&nbsp;&nbsp;
                                                        <input type="reset" name="btncancel" id="btncancel" class="btn btn-secondary btn-rounded btn-fw" style="font-size: 15px;" value="Cancel" />
                                                    </form>
                                                    <br><br><br>
                                                    <a href="viewRoomDetails.php" class="btn btn-link btn-rounded btn-fw" style="font-size: 18px;"> View Rooms</a>
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
        document.getElementById("roomcapacity").addEventListener("input", function() {
            let capacity = this.value;
            let type = document.getElementById("roomtype").value; // Get room type
            let rentField = document.getElementById("rent");


                fetch(`get_rent.php?capacity=${capacity}&type=${type}`) // Fix: Use `&` instead of `;`
                .then(response => response.text())
                .then(data => {
                    rentField.value = (data !== "Not Found") ? data : "";
                })
                .catch(error => console.error('Error fetching data:', error));
            
        });

        // Also, add an event listener for room type changes
        document.getElementById("roomtype").addEventListener("change", function() {
            document.getElementById("roomcapacity").dispatchEvent(new Event("input")); // Trigger fetch again
        });

function goBack() {
    if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
    }
    window.history.back();
}


</script>
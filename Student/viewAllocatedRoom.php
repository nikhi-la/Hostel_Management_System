<?php

include("../Assets/Connection/Connection.php");
include("SessionValidator.php");

$userSelQry = "SELECT * FROM tbl_student WHERE user_id='" . $_SESSION["user_id"] . "' AND verification_status=1 OR verification_status=3";
$rowuser = $con->query($userSelQry);
$datauser = $rowuser->fetch_assoc();

if ($rowuser->num_rows > 0){ 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>View Allocated Room</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Raleway:wght@100;200;300;400;500;600;700;800;900&family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../Assets/Template/Student/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Assets/Template/Student/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../Assets/Template/Student/vendor/aos/aos.css" rel="stylesheet">
    <link href="../Assets/Template/Student/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../Assets/Template/Student/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../Assets/Template/Student/css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="../Assets/Template/Warden/images/Logo.png" />

    <style>
        input[type=reset] {
            color: var(--contrast-color);
            background: var(--accent-color);
            border: 0;
            padding: 10px 30px;
            transition: 0.4s;
            border-radius: 50px;
            font-size: 18px;
        }

        .services .service-item {
            background-color: var(--surface-color);
            text-align: center;
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
            padding: 80px 20px;
            transition: border ease-in-out 0.3s;
            height: 50%;
            width: 50%;
        }
    </style>

</head>

<body class="index-page">
<?php
    include("header.php");
?>
    <?php
    $selQry = "SELECT * FROM tbl_roompreference rp 
               INNER JOIN tbl_room r 
               WHERE rp.room_id = r.room_id 
               AND user_id='" . $_SESSION["user_id"] . "'";
    
    $row = $con->query($selQry);
    
    if(mysqli_num_rows($row)>0){
        $data = $row->fetch_assoc();
        ?>
         <main class="main">
        <div class="container section-title" data-aos="fade-up">
            <br>
            <h2>Your Room</h2>
        </div>

        <center>
            <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <h2>Floor <?php echo $data['room_floor']; ?></h2><br>
                        <a href="" class="stretched-link">
                            <h3><?php echo "Room Number: " . $data['room_number']; ?></h3>
                            <h3><?php echo "Capacity: " . $data['room_capacity']; ?></h3>
                            <h3><?php echo "Occupants: " . $data['no_of_occupants']; ?></h3>
                            <h3><?php echo "Rent: " . $data['room_rent'] . " Rs."; ?></h3>
                        </a>
                    </div>
                    <br><br>

                    <input type="reset" name="btnsubmit" id="btnsubmit" value="<?php 
                        if ($data["room_verification_status"] == 0) {
                            $status = "Pending";
                        } elseif ($data["room_verification_status"] == 1) {
                            $status = "Accepted";
                        } else {
                            $status = "Rejected";
                        }
                        echo "Status : " . $status; 
                        ?>" />

                </div>
            </section>
        </center>
    </main>

    <br><br><br><br>

    <?php include("footer.php"); ?>
        <?php
    }
    else{
        ?>
        <script>
        alert("No Allocated Room");
        window.location = "HomepageDummy.php";
        </script>
      <?php
    }
    ?>

   

</body>

</html>

<?php
} else {
?>
    <script>
        alert("Unauthorized Access");
        window.location = "../Login.php";
    </script>
<?php
}
?>

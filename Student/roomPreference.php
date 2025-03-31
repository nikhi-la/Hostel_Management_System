<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Preference</title>

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
        input[type=submit] {
            color: var(--contrast-color);
            background: var(--accent-color);
            border: 0;
            padding: 10px 30px;
            transition: 0.4s;
            border-radius: 50px;
        }
    </style>
</head>

<body class="index-page">
    <?php
    include("../Assets/Connection/Connection.php");
    session_start();
    include("header.php");
    
    if(isset($_SESSION["user_id"]) && ($_SESSION["user_type"]=="student") )
    {
        $sel="select * from tbl_student where user_id='".$_SESSION["user_id"]."'";
        $row = $con->query($sel);
        $data = $row->fetch_assoc();
        //echo $data['caution_deposit_status'];
            if (isset($_GET["bookid"])) {
                if (!isset($_SESSION["user_id"])) {
                    ?>
                    <script>
                        alert("Please Login");
                        window.location = "../Login.php";
                    </script>
                    <?php
                } else {
                    if (isset($_POST["btnsubmit"])) {
                        $selUser = "SELECT * FROM tbl_roomchangerequest WHERE user_id='" . $_SESSION["user_id"] . "' AND roomchange_status=0";
                        $rowUser = $con->query($selUser);
                        
                        if (mysqli_num_rows($rowUser) > 0) {
                            ?>
                            <script>
                                alert("Already submitted and Pending");
                            </script>
                            <?php
                        } else {
                            $status = 0;
                            $roomChangeInsQry = "INSERT INTO tbl_roomchangerequest(user_id, room_id, reason, requested_room_id, roomchange_status) VALUES ('" . $_SESSION["user_id"] . "', 0, NULL, '" . $_GET['bookid'] . "', '" . $status . "')";
                            
                            if ($con->query($roomChangeInsQry)) {
                                ?>
                                <script>
                                    alert("Request submitted");
                                </script>
                                <?php
                            } else {
                                ?>
                                <script>
                                    alert("Request Submission Failed");
                                </script>
                                <?php
                            }
                        }
                    }
        
                    $selQry = "SELECT * FROM tbl_room WHERE room_id='" . $_GET['bookid'] . "'";
                    $row = $con->query($selQry);
                    $data = $row->fetch_assoc();
                    ?>
        
                    <main class="main">
                        <div class="container section-title" data-aos="fade-up">
                            <br>
                            <h2>Your Preference</h2>
                        </div>
        
                        <center>
                            <form id="form1" name="form1" method="post" action="">
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
                                        <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit Preference" />
                                    </div>
                                </section>
                                <?php
                                echo "<br><br>";
                                }
                                ?>
                            </form>
                        </center>
                    </main>
                    <br><br><br><br>
                    <?php
                }
        
    }
    else
    {
        
        ?>
            <script>
                alert("Please Login");
                window.location="../Login.php";
            </script>
        <?php
        
    }
        include("footer.php");
    ?>
</body>

</html>

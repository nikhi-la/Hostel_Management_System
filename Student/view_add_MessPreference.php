<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");


$selUser = "select * from tbl_student where user_id='" . $_SESSION["user_id"] . "'";
$rowu = $con->query($selUser);
$datau = $rowu->fetch_assoc();

if ($datau["verification_status"] == 1 || $datau["verification_status"] == 3 ) {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Mess Preference</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

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
        .buttoncolorveg {
            color: var(--contrast-color);
            background: var(--accent-color);
            border: 0;
            padding: 5px 10px;
            transition: 0.4s;
            border-radius: 5px;
        }

        .buttoncolornonveg {
            color: var(--contrast-color);
            background: brown;
            border: 0;
            padding: 5px 10px;
            transition: 0.4s;
            border-radius: 5px;
        }

        .services .service-item {
            background-color: var(--surface-color);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
            padding: 80px 80px;
            transition: border ease-in-out 0.3s;
            height: 50%;
            width: 100%;
        }

        table {
            background-color: white;
            border: 0.5px solid grey;
        }
    </style>

</head>

<body class="index-page">
<?php
    include("header.php");

    if (isset($_GET["vid"])) {
        $prefInsQry = "insert into tbl_messpreference(mess_id,user_id,preference_status) values('" . $_GET["vid"] . "','" . $_SESSION["user_id"] . "',1)";
        $con->query($prefInsQry);

        $updateMess = "update tbl_mess set veg_status=veg_status+1 where mess_id='" . $_GET["vid"] . "'";
        $con->query($updateMess);
    ?>
        <script>
            alert("Preference Added");
        </script>
    <?php
    } else if (isset($_GET["nvid"])) {
        $prefInsQry = "insert into tbl_messpreference(mess_id,user_id,preference_status) values('" . $_GET["nvid"] . "','" . $_SESSION["user_id"] . "',2)";
        $con->query($prefInsQry);

        $updateMess = "update tbl_mess set nonveg_status=nonveg_status+1 where mess_id='" . $_GET["nvid"] . "'";
        $con->query($updateMess);
    ?>
        <script>
            alert("Preference Added");
        </script>
    <?php
    }
    ?>

    <main class="main">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <br><br>
            <h2>View Mess</h2>
            <br><br>

            <section id="services" class="services section light-background">

                <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                    <center>
                        <table width="1200" border="1" cellpadding="10">
                            <tr>
                                <th width="10%" height="60px">Sl.No.</th>
                                <th width="15%">Date</th>
                                <th width="15%">Breakfast</th>
                                <th width="15%">Lunch</th>
                                <th width="15%">Tea Time</th>
                                <th width="15%">Dinner</th>
                                <th width="15%">Preference</th>
                            </tr>

                            <?php
                            $selRequest = "select * from tbl_mess where mess_date>=curdate()";
                            $row = $con->query($selRequest);
                            $i = 0;
                            while ($data = $row->fetch_assoc()) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i ?><input type="hidden" name="messid" id="messid" value="<?php echo $data["mess_id"] ?>" readonly /></td>
                                    <td><?php echo $data["mess_date"] ?></td>
                                    <td><?php echo $data["breakfast"] ?></td>
                                    <td><?php echo $data["lunch"] ?></td>
                                    <td><?php echo $data["tea_time"] ?></td>
                                    <td><?php echo $data["dinner"] ?></td>
                                    <td>
                                        <?php
                                        $selectfrompreference = "select * from tbl_messpreference where mess_id= '" . $data["mess_id"] . "' and user_id='" . $_SESSION["user_id"] . "'";
                                        $rowselectfrompreference = $con->query($selectfrompreference);
                                        $dataselectfrompreference = $rowselectfrompreference->fetch_assoc();

                                        if (mysqli_num_rows($rowselectfrompreference) == 0) {
                                        ?>
                                            <a href="view_add_MessPreference.php?vid=<?php echo $data["mess_id"];?>" class="buttoncolorveg">Veg</a>
                                            <a href="view_add_MessPreference.php?nvid=<?php echo $data["mess_id"];?>" class="buttoncolornonveg">Non-Veg</a>
                                        <?php
                                        } else {
                                            if ($dataselectfrompreference["preference_status"] == 1) echo "Veg";
                                            else if ($dataselectfrompreference["preference_status"] == 2) echo "Non Veg";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </center>
                </form>

                <br><br><br><br><br><br><br><br>

            </section>

        </div><!-- End Section Title -->

    </main>
    <br><br><br><br>
    <?php
    include("footer.php");
    ?>

</body>

</html>
<?php
} else {
?>
<script>
    alert("Unauthorized Access.Please Login!");
    window.location = "../Login.php";
</script>
<?php
}
?>

<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");

$selUser = "select * from tbl_student where user_id='" . $_SESSION["user_id"] . "'";
$rowu = $con->query($selUser);
$datau = $rowu->fetch_assoc();

if ($datau["verification_status"] == 1 || $datau["verification_status"] == 3) {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Bills</title>

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
?>
    <main class="main">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <br><br>
            <h2>Bills</h2>
            <br><br>

            <section id="services" class="services section light-background">

                <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
                    <center>
                        <table width="1200" border="1" cellpadding="10">
                            <tr>
                                <th width="10%" height="60px">Sl.No.</th>
                                <th width="15%">Month/Year</th>
                                <th width="15%">Mess Bill</th>
                                <th width="15%">Room Rent</th>
                                <th width="15%">Present Count</th>
                                <th width="15%">Dues</th>
                                <th width="15%">Status</th>
                                <th width="15%">Receipt</th>
                            </tr>

                            <?php
                             $selRequest = "select * from tbl_messfee mf inner join tbl_hostelrentpayment hp on mf.user_id=hp.user_id where mf.user_id='".$_SESSION["user_id"]."' and mf.month=hp.hostelrent_month and mf.year=hp.hostelrent_year order by year desc,month desc";
                             //echo $selRequest;
                             $row = $con->query($selRequest);
                            $i = 0;
                            while ($data = $row->fetch_assoc()) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo date("F", mktime(0, 0, 0, $data["month"], 1))." ".$data["year"];?></td>
                                    <td><?php echo $data["mess_fees"]." Rs." ; ?></td>
                                    <td><?php echo $data["room_rent"]." Rs." ?></td>
                                    <td><?php echo $data["present_count"]." days"; ?></td>
                                    <td><?php echo $data["due_amount"]." Rs." ?></td>
                                    <td><?php
                                    if($data["payment_status"]==0) {
                                        ?><a href="payment.php?messfeeid=<?php echo $data['messfee_id']; ?>&rentid=<?php echo $data['rent_id'];?>">Pay</a> <?php
                                    
                                    }
                                    else{
                                        echo "Paid";
                                    }
                                    ?>
                                    </td>
                                    <td><?php 
                                    if($data["payment_status"]==0) 
                                        echo "Not Paid";
                                    else{
                                    ?><a href="payReceipt.php?messfeeid=<?php echo $data['messfee_id']; ?>&rentid=<?php echo $data['rent_id'];?>">Receipt</a> <?php
                                        // echo "Receipt";
                                    }?></td> 
                                    
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

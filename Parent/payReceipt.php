<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");

$selUser = "SELECT * FROM tbl_parent WHERE user_id='" . $_SESSION["user_id"] . "'";
$rowu = $con->query($selUser);
$datau = $rowu->fetch_assoc();

if ($datau["verification_status"] == 1 $datau['verification_status']==3) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Receipt</title>
    
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
   @media print {
    body {
        margin: 0;
        padding: 0;
    }
    #receipt {
        width: auto;
        max-width: 100%;
        padding: 20px;
        border: 1px solid black;
        box-shadow: none;
        page-break-inside: avoid;
    }
    .header-container {
        display: flex !important;
        align-items: center !important;
        flex-direction: row !important;
        gap: 20px !important; /* Ensures proper spacing */
    }
    .header-container img {
        max-width: 100px !important; /* Prevents image scaling issues */
        height: auto !important;
    }
    .header-text {
        text-align: left !important;
        flex-grow: 1 !important; /* Ensures text uses available space */
    }
    .no-print {
        display: none !important;
    }
}



        input[type=submit], [type=reset] {
            color: var(--contrast-color);
            background: var(--accent-color);
            border: 0;
            padding: 10px 30px;
            transition: 0.4s;
            border-radius: 50px;
        }
        .services .service-item {
            background-color: var(--surface-color);
            border: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
            padding: 80px;
            transition: border ease-in-out 0.3s;
            height: 60%;
            width: 100%;
        }

    </style>
</head>
<body class="index-page">
    <?php include("header.php"); 
        if(isset($_GET["messfeeid"])&&isset($_GET["rentid"]))
        {
    ?>
    <main class="main">
        <center>
            <div class="container section-title" data-aos="fade-up">
                <h2>Receipt</h2>
            </div>
            <section id="services" class="services section light-background">
            <div id="receipt">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                            <?php
                            $sel = "SELECT * FROM tbl_parent p inner join tbl_student s on p.student_id=s.user_id INNER JOIN tbl_user u ON s.user_id = u.user_id WHERE p.user_id = '" . $_SESSION["user_id"] . "'";
                            $row = $con->query($sel);
                            $data = $row->fetch_assoc();
                            
                            $selMess = "SELECT * FROM tbl_messfee WHERE messfee_id = '".$_GET["messfeeid"]."'";
                            $rowMess = $con->query($selMess);
                            $dataMess = $rowMess->fetch_assoc();
                            
                            $selHostel = "SELECT * FROM tbl_hostelrentpayment WHERE rent_id = '".$_GET["rentid"]."'";
                            $rowHostel = $con->query($selHostel);
                            $dataHostel = $rowHostel->fetch_assoc();
                            ?>
                            
                                <div class="row gy-4">
                                    <div class="col-md-2">
                                        <img src="../Assets/Template/Warden/images/Logo.png" width="100" height="100"/>
                                    </div>
                                    <div class="col-md-10">
                                        <h2>HMS Hostel</h2>
                                        <h5>Kakkanad P O, Kakkanad, Ernakulam, 683546</h5>
                                        <h5>+91 9745620479, hms@gmail.com</h5>
                                    </div>
                                    <div class="col-md-2" style="text-align:left;">
                                        <b>Billing To</b>
                                    </div>
                                    <div class="col-md-8" style="text-align:left;">
                                        <?php echo ucfirst($data["student_firstname"]) . " " . ucfirst($data["student_middlename"]) . " " . ucfirst($data["student_lastname"]); ?><br>
                                        <?php echo ucfirst($data["student_housename"]); ?><br>
                                        <?php echo ucfirst($data["student_city"]); ?><br>
                                        <?php echo ucfirst($data["student_district"]); ?><br>
                                        <?php echo $data["student_pincode"]; ?><br>
                                    </div>
                                    <div class="col-md-12">
                                        <table border="1" width="680px" style="text-align:left; border-collapse: collapse;">
                                            <tr>
                                                <th width="70%" style="border: 1px solid black; padding: 8px;">Bill Type</th>
                                                <th style="border: 1px solid black; padding: 8px;">Amount</th>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid black; padding: 8px;">Mess Bill<br>Hostel Rent<br>Due Amount<br><br><br></td>
                                                <td style="border: 1px solid black; padding: 8px;">
                                                    <?php 
                                                    echo $dataMess["mess_fees"] . " Rs.<br>" . $dataHostel["room_rent"] . " Rs.<br>".$dataMess["due_amount"]." Rs.";
                                                    ?><br><br><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid black; padding: 8px;">Total</td>
                                                <td style="border: 1px solid black; padding: 8px;">
                                                    <?php echo $dataMess["mess_fees"] + $dataHostel["room_rent"]+$dataMess["due_amount"] . " Rs."; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            <br><br>
                            <div class="col-md-12 text-center">
                                <input type="submit" name="download" onclick="printReceipt()" id="download" value="Print Receipt" class="no-print" />
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </section>
            
        </center>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>
<script>
function printReceipt() {
    var receiptContent = document.getElementById("receipt").innerHTML;
    var printWindow = window.open('', '_blank');

    printWindow.document.write('<html><head><title>Print Receipt</title>');
    printWindow.document.write('<link rel="stylesheet" href="../Assets/Template/Student/css/main.css">'); // Keep the same styles
    printWindow.document.write('<style>');
    printWindow.document.write(`
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                margin: 0;
                padding: 0;
            }
            #receipt {
                width: auto;
                max-width: 100%;
                padding: 20px;
                border: 1px solid black;
                box-shadow: none;
                page-break-inside: avoid;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
        }
    `);
    printWindow.document.write('</style></head><body>');
    printWindow.document.write('<div id="receipt">' + receiptContent + '</div>');
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.print();
}
</script>

<?php 
        }else{
            ?>
            <script>
                alert("Invalid Access");
                window.location = "viewPreviousBills.php";
            </script>
            <?php
        }
} else { ?>
<script>
    alert("Unauthorized Access. Please Login!");
    window.location = "../Login.php";
</script>
<?php } ?>
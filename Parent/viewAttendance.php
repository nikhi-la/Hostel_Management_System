<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");

$selUser = "select * from tbl_parent where user_id='" . $_SESSION["user_id"] . "'";
$rowu = $con->query($selUser);
$datau = $rowu->fetch_assoc();

if ($datau["verification_status"] == 1 || $datau["verification_status"] == 3 ) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>Attendance Log</title>

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

        <!-- =======================================================
        * Template Name: eNno
        * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
        * Updated: Aug 07 2024 with Bootstrap v5.3.3
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->

        <style>
            input[type=submit],
            [type=reset] {
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
                <h2>Attendance Log</h2>
                <br><br>
               <center>
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
            <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-4">
                  Search Date
                </div>

                <div class="col-md-8">
                  
                  <input type="date" name="searchdate" id="searchdate" class="form-control"  />
                </div>
                
                <br><br><br><br>
                <div class="col-md-12 text-center">

                <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                  <input type="submit" name="btnsearch" id="btnsearch" value="Search" />
                  <input type="submit" name="btncancel" id="btncancel" value="Cancel" />
                 
                </div>

              </div>
            </form>
                    </div>
                    

                </div>
          </center>
            </div><!-- End Section Title -->

            <?php
            if(isset($_POST["btnsearch"]))
            {
                ?>
                  <center>
                <section id="services" class="services section light-background">
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">

                        <table width="600" border="1" cellpadding="10">
                            <tr>
                                <th width="40%">Sl No</th>
                                <th width="50%">Date</th>
                                <th width="10%">Attendance</th>
                            </tr>

                            <?php
                            $SelQry = "select * from tbl_attendance a inner join tbl_parent p on a.user_id=p.student_id where p.user_id='" . $_SESSION["user_id"] . "' and attendance_date='".$_POST["searchdate"]."' order by attendance_date desc";
                            $row = $con->query($SelQry);

                            $i = 0;
                            while ($data = $row->fetch_assoc()) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data["attendance_date"] ?></td>
                                    <td>
                                        <?php
                                        if ($data["attendance_status"] == 0)
                                            echo "Absent";
                                        else
                                            echo "Present";
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>

                        <br><br><br><br><br><br><br><br>

                    </div>
                </section>
            </center>
                <?php
            }
            else if(isset($_POST["btncancel"]))
            {
                ?>
                    <script>
                    window.location="viewAttendance.php";
                    </script>
                <?php
            }
            else{

          ?>

            <center>
                <section id="services" class="services section light-background">
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">

                        <table width="600" border="1" cellpadding="10">
                            <tr>
                                <th width="40%">Sl No</th>
                                <th width="50%">Date</th>
                                <th width="10%">Attendance</th>
                            </tr>

                            <?php
                            $SelQry = "select * from tbl_attendance a inner join tbl_parent p on a.user_id=p.student_id where p.user_id='" . $_SESSION["user_id"] . "' order by attendance_date desc";
                            $row = $con->query($SelQry);

                            $i = 0;
                            while ($data = $row->fetch_assoc()) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data["attendance_date"] ?></td>
                                    <td>
                                        <?php
                                        if ($data["attendance_status"] == 0)
                                            echo "Absent";
                                        else
                                            echo "Present";
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>

                        <br><br><br><br><br><br><br><br>

                    </div>
                </section>
            </center>
          <?php
          }
          ?>
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

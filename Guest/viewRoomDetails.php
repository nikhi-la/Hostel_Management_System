<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Room Details</title>

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
    a.button {
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
 include("header.php");
 include("../Assets/Connection/Connection.php");

 $sel="select * from tbl_basic where basic_id=1";
 $rowSel=$con->query($sel);
 $dataSel=$rowSel->fetch_assoc();
 ?>

  <main class="main">
  <div class="container section-title" data-aos="fade-up">
<br>
<h2>Choose Your Rooms</h2>
</div><!-- End Section Title -->
    <center>
        <form id="form1" name="form1" method="post" action="roomPreference.php">
            <?php
            for ($j = 1; $j <= $dataSel["floor_count"]; ++$j) {
                $selQry = "SELECT * FROM tbl_room WHERE room_floor = $j";
                $row = $con->query($selQry);
            ?>  
                    <div style="position: relative; display: inline-block; margin: 10px; 
                            padding: 15px;border-radius: 10px;
                            width: 200px;color:white; background-color: #10bc69; top: -40px;";> <!-- Set a width for proper alignment -->

                        <!-- Room Type (Centered) -->
                        <div style="text-align: center;  font-size: 20px;">
                        <?php echo "<br>Floor " . $j."<br><br>"; ?>
                        </div>
                    </div>
                
                <?php
                while ($data = $row->fetch_assoc()) {    
                ?>

                <!-- Room Details -->
                <div style="position: relative; display: inline-block; margin: 10px; 
                            padding: 15px; border: 2px solid black; border-radius: 10px;
                            background-color: <?php echo ($data['room_capacity'] == $data['no_of_occupants']) ? '#f8d7da' : '#F0F4EB'; ?>;
                            width: 200px;"> <!-- Set a width for proper alignment -->

                    <!-- Room Type (Centered) -->
                    <div style="text-align: center; font-weight: bold; font-size: 18px;">
                        <?php echo $data['room_capacity']." Share  ( ";
                        if($data["room_type"]==1) echo "AC";
                        else if($data["room_type"]==2) echo "Non AC";
                        echo " )" ?>
                    </div>
                    
                    <!-- Room Details (Left-aligned) -->
                    <div style="text-align: left; margin-top: 10px;">
                        <?php 
                            echo "Room Number: " . $data['room_number'] . "<br>" .
                                "Occupants: " . $data['no_of_occupants'] . "<br>" .
                                "Vacancy: " . ($data['room_capacity'] - $data['no_of_occupants']) . " Room(s)<br>" .
                                "Rent: " . $data['room_rent'] . " Rs.<br>"; 
                        ?>
                    </div>

                    <!-- Book Room Link (Centered) -->
                    <div style="text-align: center; margin-top: 10px;">
                        <?php if ($data['room_capacity'] != $data['no_of_occupants']) { ?>
                            <a href="../Student/roomPreference.php?bookid=<?php echo $data['room_id']; ?>" 
                            title="Book" 
                            style="padding: 5px 10px; text-decoration: none; color: blue;
                                    border-radius: 5px; display: inline-block;">
                                Book
                            </a>
                        <?php } else { ?>
                            <div style="padding: 5px 10px; background-color: red; color: white; 
                                        border-radius: 5px;">
                                Room Full
                            </div>
                        <?php } ?>
                    </div>

                </div>

                <?php
                }
                echo "<br><br>";
                ?>
                    <hr style="color:#10bc69; width: 90%;"><br>
                <?php
            }
            ?>
        </form>
    </center>
    </main>
    <br><br><br><br>
<?php
 include("footer.php");
 ?>

</body>

</html>


</body>
</html>

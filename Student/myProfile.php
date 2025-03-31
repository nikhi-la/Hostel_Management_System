<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("header.php");

$selUser="select * from tbl_student where user_id='".$_SESSION["user_id"]."'";
//echo $selUser;
$rowu=$con->query($selUser);
$datau=$rowu->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>My Profile</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
  <link href="../Assets/Template/Student/css/main.css" rel="stylesheet"/>
  <link rel="shortcut icon" href="../Assets/Template/Warden/images/Logo.png" />

  <style>
    input[type=submit],[type=reset] {
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
      height: 125%;
      width: 100%;
    }
        .profile-photo {
                width: 100px;  /* Adjust size as needed */
                height: 100px; /* Ensure it's a perfect square */
                border-radius: 50%; /* Makes it round */
                object-fit: cover; /* Ensures the image fills the circle properly */
                border: 2px solid #000; /* Optional: Adds a black border */
                margin: auto;
            }


  </style>

</head>

<body class="index-page">
  <?php

if(isset($_POST["btnUpdate"]))
{
    if ($_FILES["photo"]["error"] == 4) { // Error code 4 means no file was uploaded
        #echo "No file chosen. Please select a file.";
        $updateQry="update tbl_student set student_firstname='".$_POST["firstname"]."',student_middlename='".$_POST["middlename"]."',student_lastname='".$_POST["lastname"]."',student_dob='".$_POST["dob"]."',student_gender='".$_POST["gender"]."',student_country='".$_POST["country"]."',student_district='".$_POST["district"]."',student_city='".$_POST["city"]."',student_housename='".$_POST["housename"]."',student_pincode='".$_POST["pincode"]."',student_contact='".$_POST["contact"]."' where user_id='".$_SESSION["user_id"]."'";
        if($con->query($updateQry)){
          ?>
          <script>
              alert("Profile Updated");
              window.location = "myProfile.php";
          </script>
          <?php
        }

    } 
    else {
        
        $photo=$_FILES["photo"]["name"];
        
        $temp_photo=$_FILES["photo"]["tmp_name"];

        move_uploaded_file($temp_photo,"../Assets/Files/StudentPhoto/".$photo);

        $updateQry="update tbl_student set student_firstname='".$_POST["firstname"]."',student_middlename='".$_POST["middlename"]."',student_lastname='".$_POST["lastname"]."',student_dob='".$_POST["dob"]."',student_gender='".$_POST["gender"]."',student_country='".$_POST["country"]."',student_district='".$_POST["district"]."',student_city='".$_POST["city"]."',student_housename='".$_POST["housename"]."',student_pincode='".$_POST["pincode"]."',student_contact='".$_POST["contact"]."',student_photo='".$photo."' where user_id='".$_SESSION["user_id"]."'";
        
        if($con->query($updateQry)){
          ?>
          <script>
              alert("Profile Updated");
              window.location = "myProfile.php";
          </script>
          <?php
        }

    }
}

  if(isset($_POST["btnedit"]))
  {
    ?>


    <main class="main">
  
  <center>
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
  
  <h2>Edit Profile</h2>
  </div><!-- End Section Title -->
            <section id="services" class="services section light-background">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
            <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form"  data-aos="fade-up" data-aos-delay="200">
           
          
            <div class="row gy-4">
  
                <div class="col-md-4">
                  <b>First Name</b>
                </div>
  
                <div class="col-md-8">
                  
                  <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $datau["student_firstname"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                  <b>Middle Name</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="middlename" id="middlename" class="form-control" value="<?php echo $datau["student_middlename"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                  <b>Last Name</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $datau["student_lastname"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                <b>DOB</b>
                </div>
  
                <div class="col-md-8">
                <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $datau["student_dob"]?>" />
                </div>
  
                <br><br><br>
                <div class="col-md-4">
                <b>Gender</b>
                </div>
  
                <div class="col-md-8">
                    <select name="gender" id="gender" class="form-control">
                        <?php
                            if($datau["student_gender"]=="Female"){
                                ?>
                                    <option value="Female" selected>Female</option>
                                    <option value="Male">Male</option>
                                    <option value="Others">Others</option>
                                <?php
                            }
                            else if($datau["student_gender"]=="Male"){
                                ?>
                                    <option value="Female" >Female</option>
                                    <option value="Male" selected>Male</option>
                                    <option value="Others">Others</option>
                                <?php
                            }
                            else{
                                ?>
                                    <option value="Female" >Female</option>
                                    <option value="Male">Male</option>
                                    <option value="Others" selected>Others</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
  
                <br><br><br>
  
                <div class="col-md-4">
                <b>Housename</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="housename" id="housename" class="form-control" value="<?php echo $datau["student_housename"]?>" />
                </div>
  
                <br><br><br>

                <div class="col-md-4">
                  <b>City</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="city" id="city" class="form-control" value="<?php echo $datau["student_city"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                  <b>District</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="district" id="district" class="form-control" value="<?php echo $datau["student_district"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                  <b>Country</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="country" id="country" class="form-control" value="<?php echo $datau["student_country"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                  <b>Pincode</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo $datau["student_pincode"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                <b>Contact</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="contact" id="contact" class="form-control" value="<?php echo $datau["student_contact"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                <b>Photo</b>
                </div>
  
                <div class="col-md-8">
                <input type="file" name="photo" id="photo"  class="form-control"  />
                <p>Current File: 
                <a href="../Assets/Files/studentPhoto/<?php echo $datau['student_photo']; ?>" target="_blank" download>
    <?php echo $datau['student_photo']; ?>
</a>

                </p>
                </div>
                
                <br><br><br><br><br>
                <div class="col-md-12 text-center">
                  <input type="submit" name="btnUpdate" id="btnUpdate" value="Update" />
                  <input type="reset" name="btnReset" id="btnReset" value="Cancel" />
                </div>
  
              </div>
            </form>
                    </div>
                    <br><br>
  
                </div>
            </section>
        </center>
  </main>
      <?php
  }
  else{
    ?>


  <main class="main">

<center>
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">

<h2>My Profile</h2>
</div><!-- End Section Title -->
          <section id="services" class="services section light-background">
              <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                  <div class="service-item position-relative">
          <form id="form1" name="form1" action="" method="post" enctype="multipart/form-data" class="php-email-form"  data-aos="fade-up" data-aos-delay="200">
          
                
          <a href="../Assets/Files/studentPhoto/<?php echo $datau['student_photo']; ?>" target="_blank">
  <img src="../Assets/Files/studentPhoto/<?php echo $datau['student_photo']; ?>" 
  class="profile-photo" style="text-align: center;" />
</a>
                 <br><br><br><br><br>
          <div class="row gy-4">

              <div class="col-md-4">
                <b>Name</b>
              </div>

              <div class="col-md-8">
                
                <input type="text" class="form-control" value="<?php echo $datau["student_firstname"]." ".$datau["student_middlename"]." ".$datau["student_lastname"] ?>" readonly/>
              </div>
              <br><br><br>
              <div class="col-md-4">
              <b>DOB</b>
              </div>

              <div class="col-md-8">
              <input type="text" class="form-control" value="<?php echo $datau["student_dob"]?>" readonly/>
              </div>

              <br><br><br>
              <div class="col-md-4">
              <b>Gender</b>
              </div>

              <div class="col-md-8">
              <input type="text" class="form-control" value="<?php echo $datau["student_gender"]?>" readonly/>
              </div>

              <br><br><br>

              <div class="col-md-4">
              <b>Address</b>
              </div>

              <div class="col-md-8">
                <textarea class="form-control" required readonly rows="5"><?php echo $datau["student_housename"]."\n".
                $datau["student_city"]."\n".
                $datau["student_district"]."\n".
                $datau["student_country"]."\n".
                $datau["student_pincode"]."\n";?></textarea>
              </div>

              <br><br><br>
              <div class="col-md-4">
              <b>Contact</b>
              </div>

              <div class="col-md-8">
              <input type="text" class="form-control" value="<?php echo $datau["student_contact"]?>" readonly/>
              </div>
              
              <br><br><br>
              <div class="col-md-4">
              <b>Proof</b>
              </div>
              <div class="col-md-1">
              <a href="../Assets/Files/studentProof/<?php echo $datau["student_proof"]; ?>" download  >
              <i class="fa fa-download" style="font-size:30px;color:grey;"></i>
              </a>
              </div>

              <br><br><br><br> 
              <div class="col-md-12 text-center">

              <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
                <input type="submit" name="btnedit" id="btnedit" value="Edit Profile" />
              </div>

            </div>
          </form>
                  </div>
                  <br><br>

              </div>
          </section>
      </center>
</main>
    <?php
  }
  ?>
    <br><br><br><br>
<?php
 include("footer.php");
 ?>

</body>

</html>

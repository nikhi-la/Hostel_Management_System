<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include("header.php");

$selUser="select * from tbl_parent where user_id='".$_SESSION["user_id"]."'";
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
  <link href="../Assets/Template/Student/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eNno
  * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

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
      height: 90%;
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
        $updateQry="update tbl_parent set parent_name='".$_POST["name"]."',parent_contact='".$_POST["contact"]."',parent_relation='".$_POST["relation"]."'";
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

        move_uploaded_file($temp_photo,"../Assets/Files/ParentPhoto/".$photo);

        $updateQry="update tbl_parent set parent_name='".$_POST["name"]."',parent_contact='".$_POST["contact"]."',parent_relation='".$_POST["relation"]."',parent_photo='".$photo."'";
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
                  <b>Name</b>
                </div>
  
                <div class="col-md-8">
                  
                  <input type="text" name="name" id="name" class="form-control"  pattern="[A-Za-z]+" title="Only letters are allowed" value="<?php echo $datau["parent_name"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                  <b>Relation</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="relation" id="relation" class="form-control"  pattern="[A-Za-z]+" title="Only letters are allowed" value="<?php echo $datau["parent_relation"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                <b>Contact</b>
                </div>
  
                <div class="col-md-8">
                <input type="text" name="contact" id="contact" class="form-control" pattern="[0-9]{10}" title="Phone number must be 10 digits" value="<?php echo $datau["parent_contact"]?>" />
                </div>
                <br><br><br>

                <div class="col-md-4">
                <b>Photo</b>
                </div>
  
                <div class="col-md-8">
                <input type="file" name="photo" id="photo"  class="form-control"  />
                <p>Current File: 
                <a href="../Assets/Files/ParentPhoto/<?php echo $datau['parent_photo']; ?>" target="_blank" download>
                    <?php echo $datau['parent_photo']; ?>
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
          
                
          <a href="../Assets/Files/ParentPhoto/<?php echo $datau['parent_photo']; ?>" target="_blank">
  <img src="../Assets/Files/ParentPhoto/<?php echo $datau['parent_photo']; ?>" 
  class="profile-photo" style="text-align: center;" />
</a>
                 <br><br><br><br><br>
          <div class="row gy-4">

              <div class="col-md-4">
                <b>Name</b>
              </div>

              <div class="col-md-8">
                <input type="text" class="form-control" value="<?php echo $datau["parent_name"] ?>" readonly/>
              </div>
              
              <br><br><br>
              <div class="col-md-4">
                <b>Relation</b>
              </div>

              <div class="col-md-8">
                <input type="text" class="form-control" value="<?php echo $datau["parent_relation"] ?>" readonly/>
              </div>
              
              <br><br><br>
              <div class="col-md-4">
              <b>Contact</b>
              </div>

              <div class="col-md-8">
              <input type="text" class="form-control" value="<?php echo $datau["parent_contact"]?>" readonly/>
              </div>
              
              <br><br><br>
              <div class="col-md-4">
              <b>Proof</b>
              </div>
              <div class="col-md-1">
              <a href="../Assets/Files/ParentProof/<?php echo $datau["parent_proof"]; ?>" download>
              <i class="fa fa-download" style="font-size:30px;color:grey;"></i>
              </a>
              </div>

              <br><br><br><br> 
              <div class="col-md-12 text-center">
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

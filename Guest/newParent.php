<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Registration</title>

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
    input[type=submit],[type=reset] {
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

 if(isset($_SESSION["temp_student_id"])){
 
 include("../Assets/Connection/Connection.php");
if(isset($_POST["btnsave"]))
{

        $countOfUsers="select * from tbl_parent";
        $row=$con->query($countOfUsers);
        $count = mysqli_num_rows($row);
        
        $count++;
        $length=strlen($count);
        if($length==1)
            $zero="000";
        if($length==2)
            $zero="00";
        if($length==3)
            $zero="0";
        if($length==4)
            $zero="";

        $userid="P".$zero.$count;
        $usertype="parent";
        $password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*"), 0, 10);

        $userInsQry="insert into tbl_user(user_id,user_email,user_password,user_type)values('".$userid."','".$_POST["email"]."','".$password."','".$usertype."')";
        $con->query($userInsQry);

        $photo=$_FILES["photo"]["name"];
        $proof=$_FILES["proof"]["name"];
        $temp_photo=$_FILES["photo"]["tmp_name"];
        $temp_proof=$_FILES["proof"]["tmp_name"];

        move_uploaded_file($temp_photo,"../Assets/Files/ParentPhoto/".$photo);
        move_uploaded_file($temp_proof,"../Assets/Files/ParentProof/".$proof);

        $status = 0;

        $parentInsQry="insert into tbl_parent(user_id,student_id,verification_status,parent_name,parent_relation,parent_contact,parent_photo,parent_proof)values('".$userid."','".$_SESSION["temp_student_id"]."',0,'".$_POST["name"]."','".$_POST["relation"]."','".$_POST["contact"]."','".$photo."','".$proof."')";
        if($con->query($parentInsQry))
        {
          unset($_SESSION["temp_student_id"]);
            ?>
            <script>
            alert("Student Registered.Please wait for the warden to confirm for additional functionalities");  
				    window.location="../Login.php";
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
            alert("Student Not Added");
            </script>
            <?php
        }
    
  }
 ?>

  <main class="main">

    <!-- Register Section -->
    <section  class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">

        <h2>Add Guardian Details</h2>
       </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
       
          
            <form id="form1" name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-4">
                  <label for="name" class="pb-2">Name</label>
                  <input type="text" name="name" id="name"  class="form-control" pattern="[A-Za-z ]+" title="Only letters are allowed" autocomplete="off" required=""/>
                </div>


                <div class="col-md-6">
                    <label for="relation" class="pb-2">Relation</label>
                    <input type="text" name="relation" id="relation" class="form-control" pattern="[A-Za-z]+" title="Only letters are allowed" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="email" class="pb-2">Email</label>
                    <input type="text" name="email" id="email" class="form-control" onblur="validateEmail(this)" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="contact" class="pb-2">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" pattern="[0-9]{10}" title="Phone number must be 10 digits"   required="required" autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="photo" class="pb-2">Photo</label>
                    <input type="file" name="photo" id="photo" required="required" class="form-control"  autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="proof" class="pb-2">Proof</label>
                    <input type="file" name="proof" id="proof"  required="required" class="form-control" autocomplete="off"/>
                </div>

                <div class="col-md-12 text-center">

                  <input type="submit" name="btnsave" id="btnsave" value="Add"/>
                  <input type="reset" name="btncancel" id="btncancel" value="Cancel" />
                </div>

              </div>
            </form>
      </div>
    </section><!-- /Contact Section -->

  </main>
    <br><br><br><br>
<?php
 include("footer.php");
 ?>

</body>

</html>
<?php
 }
 else{
  ?>
      <script>
      alert("Failed To Load The Page");
      window.location="../index.php";
      </script>
  <?php
 }
?>
<script>
function validateEmail(input) {
    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(input.value)) {
        alert("Invalid email format! Please enter a valid email (e.g., example@mail.com).");
        input.value = "";
    }
}
</script>
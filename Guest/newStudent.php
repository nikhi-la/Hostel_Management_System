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
 include("../Assets/Connection/Connection.php");
 include '../email.php';

if(isset($_POST["btnsave"]))
{
    if($_POST["password"]==$_POST["cpassword"])
    {
        $countOfUsers="select * from tbl_student";
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

        $userid="S".$zero.$count;
        $usertype="student";

        $selUser="select * from tbl_user where user_email='".$_POST["email"]."'";
        $row=$con->query($selUser);
        if(mysqli_num_rows($row)==0){
          $userInsQry="insert into tbl_user(user_id,user_email,user_password,user_type)values('".$userid."','".$_POST["email"]."','".$_POST["password"]."','".$usertype."')";
          $con->query($userInsQry);

          $photo=$_FILES["photo"]["name"];
          $proof=$_FILES["proof"]["name"];
          $temp_photo=$_FILES["photo"]["tmp_name"];
          $temp_proof=$_FILES["proof"]["tmp_name"];

          move_uploaded_file($temp_photo,"../Assets/Files/StudentPhoto/".$photo);
          move_uploaded_file($temp_proof,"../Assets/Files/StudentProof/".$proof);

          $status = 0;

          $studentInsQry="insert into tbl_student(user_id,verification_status,student_firstname,student_middlename,student_lastname,student_dob,student_gender,student_country,student_district,student_city,student_housename,student_pincode,student_contact,student_photo,student_proof,student_doj)values('".$userid."','".$status."','".$_POST["firstname"]."','".$_POST["middlename"]."','".$_POST["lastname"]."','".$_POST["dob"]."','".$_POST["gender"]."','".$_POST["country"]."','".$_POST["district"]."','".$_POST["city"]."','".$_POST["housename"]."','".$_POST["pincode"]."','".$_POST["contact"]."','".$photo."','".$proof."',curdate())";
          if($con->query($studentInsQry))
          {
              $_SESSION["temp_student_id"]=$userid;

              $recipientEmail= $_POST["email"];
              $subject="Welcome Message";

              $message = "Dear " . $_POST["firstname"] . " " . $_POST["middlename"] . " " . $_POST["lastname"] . ",<br>";
              $message .= "Welcome to HMS! We’re delighted to have you choose us.<br> Your registration is ongoing, and you can start managing your hostel activities with ease.<br><br>";
              $message .= "You can now explore available rooms and book one that suits you.<br><br>";
              $message .= "<b>What you can do now:</b><br>";
              $message .= "✔ View available room details.<br>";
              $message .= "✔ Submit a booking request.<br>";
              $message .= "Once the warden approves your application, you will gain access to additional features.<br><br>";
              $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
              $message .= "Thank You.";

              sendEmail($recipientEmail,$subject,$message);

              ?>
              <script>
              //alert("Student Registered.Please wait for the warden to confirm for additional functionalities");  
              window.location="newParent.php";
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
        else{
          ?>
              <script>
              alert("User Already Exist");
              </script>
              <?php
        }
    }
    else{
        ?>
            <script>
            alert("password mismatch");
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

        <h2>Register</h2>
       </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
       
          
            <form id="form1" name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-4">
                  <label for="firstname" class="pb-2">First Name</label>
                  <input type="text" name="firstname" id="firstname"  class="form-control" autocomplete="off" pattern="[A-Za-z]+" title="Only letters are allowed" required=""/>
                </div>

                <div class="col-md-4">
                  <label for="middlename" class="pb-2">Middle Name</label>
                  <input type="text" name="middlename" id="middlename"  class="form-control" pattern="[A-Za-z]+" title="Only letters are allowed" autocomplete="off" />
                </div>

                <div class="col-md-4">
                  <label for="lastname" class="pb-2">Last Name</label>
                  <input type="text" name="lastname" id="lastname"  class="form-control" pattern="[A-Za-z]+" title="Only letters are allowed" autocomplete="off" required=""/>
                </div>

                <div class="col-md-6">
                  <label for="dob" class="pb-2">Date of Birth</label>
                  <input type="date" name="dob" id="dob" class="form-control" required="required" autocomplete="off"/>                 
                </div>

                <div class="col-md-6">
                  <label for="gender" class="pb-2">Gender</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="gender" id="gender" value="Male"  autocomplete="off" required="required"/>
                        &nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" id="gender" value="Female" autocomplete="off" required="required"/>
                        &nbsp; Female&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" id="gender"  value="Others" autocomplete="off" required="required"/>
                        &nbsp;Others
                </div>

                <div class="col-md-6">
                    <label for="country" class="pb-2">Country</label>
                    <input type="text" name="country" id="country" class="form-control" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="district" class="pb-2">District</label>
                    <input type="text" name="district" id="district" class="form-control" pattern="[A-Za-z]+" title="Only letters are allowed" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-4">
                    <label for="city" class="pb-2">City</label>
                    <input type="text" name="city" id="city" class="form-control" pattern="[A-Za-z]+" title="Only letters are allowed" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-4">
                    <label for="housename" class="pb-2">House Name</label>
                    <input type="text" name="housename" id="housename" class="form-control"  required="required" autocomplete="off"/>
                </div>

                <div class="col-md-4">
                    <label for="pincode" class="pb-2">Pincode</label>
                    <input type="text" name="pincode" id="pincode" class="form-control" required pattern="[0-9]{6}" title="Pincode must be exactly 6 digits" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="email" class="pb-2">Email</label>
                    <input type="text" name="email" id="email" class="form-control" onblur="validateEmail(this)" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="contact" class="pb-2">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" pattern="[0-9]{10}" title="Phone number must be 10 digits" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="photo" class="pb-2">Photo</label>
                    <input type="file" name="photo" id="photo" required="required" class="form-control"  autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="proof" class="pb-2">Proof</label>
                    <input type="file" name="proof" id="proof"  required="required" class="form-control" autocomplete="off"/>
                </div>

                <div class="col-md-6">
                    <label for="password" class="pb-2">Password</label>
                    <input type="password" name="password" id="password" class="form-control" minlength="9" title="Password must be greater than 8 characters" required="required" autocomplete="off" >
                </div>

                <div class="col-md-6">
                    <label for="cpassword" class="pb-2">Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" minlength="9" title="Password must be greater than 8 characters" required="required" autocomplete="off"/>
                </div>

                <div class="col-md-12 text-center">

                <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                  <input type="submit" name="btnsave" id="btnsave" value="Register"/>
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
<script>
function validateEmail(input) {
    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(input.value)) {
        alert("Invalid email format! Please enter a valid email (e.g., example@mail.com).");
        input.value = "";
    }
}
</script>
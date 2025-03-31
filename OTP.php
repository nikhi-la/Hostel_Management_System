<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Forgot Password</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="Assets/Template/Login/css/style.css">
    
	<link rel="shortcut icon" href="Assets/Template/Warden/images/Logo.png" />

</head>

<body >
<?php

include("Assets/Connection/Connection.php");

session_start();

if(isset($_SESSION['email'])){

    if(isset($_POST["btnOTP"])){
        $otp=$_POST["txt_otp"];
        //echo $email;

        if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiry'])) {
            if (time() > $_SESSION['otp_expiry']) {
                ?>
                    <script>
                    alert("OTP expired");
                    window.location="forgotPassword.php";
                    </script>
                <?php
                unset($_SESSION['otp']);
                unset($_SESSION['otp_expiry']);
            } 
            else if($_SESSION['otp']!=$otp){
                ?>
                    <script>
                    alert("Invalid OTP");
                    </script>
                <?php
            }
            else {
                unset($_SESSION['otp']);
                unset($_SESSION['otp_expiry']);
                ?>
                    <script>
                    window.location="resetPassword.php";
                    </script>
                <?php
            }
        }
        

    

    }

    ?>
    <section class="ftco-section">
            <div class="container">
            <br><br><br><br>
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-6">
                        <div class="wrap">
                            <div class="login-wrap p-3 p-md-5">
                            <div class="form-group mt-0">
                                <form action="#" class="signin-form" method="post">
                                <input type="text" class="form-control" name="txt_otp" pattern="[0-9]{6}" title="OTP must be exactly 6 digits" required autocomplete="off">
                                <label class="form-control-placeholder" for="username">Enter OTP</label>
                            </div>
                        
                        <div class="form-group">
                            <button type="submit" name="btnOTP"  class="form-control btn btn-primary rounded submit px-3">Submit</button>
                        </div>
                </form>
                    
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="Assets/Template/Login/js/jquery.min.js"></script>
    <script src="Assets/Template/Login/js/popper.js"></script>
    <script src="Assets/Template/Login/js/bootstrap.min.js"></script>
    <script src="Assets/Template/Login/js/main.js"></script>
    </body>
    </html>
<?php
}
else{
    ?>
        <script>
            alert("Invalid Access");
            window.location="Login.php";
        </script>
    <?php
}
?>


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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Assets/phpmailer/src/Exception.php';
require 'Assets/phpmailer/src/PHPMailer.php';
require 'Assets/phpmailer/src/SMTP.php';

session_start();
if(isset($_SESSION['email'])){

    if(isset($_POST["btnSave"])){
        $new=$_POST["newPassword"];
        $confirm=$_POST["confirmPassword"];
        
        if($new==$confirm){
            $updateQry="update tbl_user set user_password='".$new."' where user_email='".$_SESSION["email"]."'";
            if($con->query($updateQry))
            {            
                //Sending Email Start
                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'hmshostel@gmail.com';
                $mail->Password= 'zhlljothtysockzf';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('hmshostel@gmail.com');

                $mail->addAddress($_SESSION["email"]);

                $mail->isHTML(true);

                $mail->Subject = "Password Changed";
                $mail->Body = "Your new password has been updated.";  

                if($mail->send()){
                    unset($_SESSION['email']);
                    ?>
                        <script>
                        alert("Password Changed");
                        window.location="Login.php";
                        </script>
                    <?php
                }
                //Sending Email End
            }
        }
        else{
            ?>
                <script>
                alert("Password Mismatch");
                window.location="Login.php";
                </script>
            <?php
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
                                <input type="password" class="form-control" name="newPassword" minlength="9" title="Password must be greater than 8 characters" required autocomplete="off">
                                <label class="form-control-placeholder" for="username">New Password</label>
                            </div>

                            <div class="form-group mt-0">
                                <form action="#" class="signin-form" method="post">
                                <input type="password" class="form-control" name="confirmPassword" minlength="9" title="Password must be greater than 8 characters" required autocomplete="off">
                                <label class="form-control-placeholder" for="username">Confirm Password</label>
                            </div>
                        
                        <div class="form-group">
                            <button type="submit" name="btnSave"  class="form-control btn btn-primary rounded submit px-3">Submit</button>
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

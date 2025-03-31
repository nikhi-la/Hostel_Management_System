<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Login</title>
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
if(isset($_POST["btnlogin"]))
{
	$selecteduser="select * from tbl_user where user_email='".$_POST["txt_email"]."' and user_password='".$_POST["txt_pass"]."'" ;
	$row=$con->query($selecteduser);
	$data=$row->fetch_assoc();

	$selStud="select * from tbl_student where user_id='".$data["user_id"]."' and verification_status=4";
	$rowSelStud=$con->query($selStud);

	$selParent="select * from tbl_parent where user_id='".$data["user_id"]."' and verification_status=4";
	$rowSelParent=$con->query($selParent);

	if(mysqli_num_rows($rowSelStud)>0 || mysqli_num_rows($rowSelParent)>0){
		?>
				<script>
				alert("Account Removed");
				</script>
			<?php
	}
	else{
		if(mysqli_num_rows($row)>0)
		{
			$_SESSION["user_id"]=$data["user_id"];
			$_SESSION["user_email"]=$data["user_email"];
			$_SESSION["user_type"]=$data["user_type"];

			if($data["user_type"]=="warden")
			{
				#echo $_SESSION["user_id"],$_SESSION["user_email"];

				?>
					<script>
					alert("Welcome Warden");
					window.location="Warden/index.php";
					</script>
				<?php
			}
			else if($data["user_type"]=="student")
			{
				?>
					<script>
					alert("Welcome Student");
					window.location="index.php";
					</script>
				<?php
			}
			else
			{
				?>
				<script>
				alert("Welcome Parent");
				window.location="Parent/index.php";
				</script>
				<?php
			}
		}
		else{
			?>
			<script>
			alert("Invalid User");
			window.location="Login.php";
			</script>
			<?php
		}
	}

}
?>
<section class="ftco-section">
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
                    <center><br>
						<img src="Assets/Template/Warden/images/Logo.png" width="210" height="210"/></center>
						<div class="login-wrap p-3 p-md-5">
			      		<div class="form-group mt-0">
			      			<form action="#" class="signin-form" method="post">
			      			<input type="email" class="form-control" name="txt_email" required autocomplete="off">
			      			<label class="form-control-placeholder" for="username">Email</label>
			      		</div>
		            <div class="form-group">
		              <input id="password-field" type="password" class="form-control" name="txt_pass" required autocomplete="off">
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" name="btnlogin"  class="form-control btn btn-primary rounded submit px-3">Log In</button>
		            </div>
	          </form>
		          <p class="text-center"> <a  href="forgotPassword.php">Forgot Password</a></p>
		          <p class="text-center"> <a  href="Guest/newStudent.php">Don't have an account?Sign In</a></p>
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

<script>
//Show Password
const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#txt_pass');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

</script>

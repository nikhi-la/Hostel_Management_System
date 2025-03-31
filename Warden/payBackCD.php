<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>

<link rel="shortcut icon" href="../Assets/Template/Warden/images/Logo.png" />
</head>
<style>
.back-button {
    position: fixed;
    bottom: 40px;
    right: 100px;
    z-index: 1000;
    padding: 10px 15px;
    font-size: 18px;
    border-radius: 50%;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
}
.back-button:hover {
    background-color: #555;
}
.front-button {
    position: fixed;
    bottom: 40px;
    right: 50px;
    z-index: 1000;
    padding: 10px 15px;
    font-size: 18px;
    border-radius: 50%;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
}
.front-button:hover {
    background-color: #555;
}
</style>
<body>



<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - payment checkout</title>
  
<style>
@import url('https://fonts.googleapis.com/css?family=Baloo+Bhaijaan|Ubuntu');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Ubuntu', sans-serif;
}

body{
  background: #2196F3;
  margin: 0 10px;
}

.payment{
  background: #f9f9f9;
  max-width: 360px;
  margin: 80px auto;
  height: auto;
  padding: 35px;
  padding-top: 70px;
  border-radius: 5px;
  position: relative;
}

.payment h2{
  text-align: center;
  letter-spacing: 2px;
  margin-bottom: 40px;
  color: #0d3c61;
}

.form .label{
  display: block;
  color: #555566;
  margin-bottom: 6px;
}

.input{
  padding: 13px 0px 13px 25px;
  width: 100%;
  text-align: center;
  border: 2px solid #dddddd;
  border-radius: 5px;
  letter-spacing: 1px;
  word-spacing: 3px;
  outline: none;
  font-size: 16px;
  color: #555566;
}

.card-grp{
  display: flex;
  justify-content: space-between;
}

.card-item{
  width: 48%;
}

.space{
  margin-bottom: 20px;
}

.icon-relative{
  position: relative;
}

.icon-relative .fas,
.icon-relative .far{
  position: absolute;
  bottom: 12px;
  left: 15px;
  font-size: 20px;
  color: #555555;
}

.btn{
  margin-top: 40px;
  background: #2196F3;
  padding: 12px;
  text-align: center;
  color: #f8f8f8;
  border-radius: 5px;
  cursor: pointer;
}


.payment-logo{
  position: absolute;
  top: -50px;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 100px;
  background: #f8f8f9;
  border-radius: 50%;
  box-shadow: 0 0 5px rgba(0,0,0,0.2);
  text-align: center;
  line-height: 85px;
}

.payment-logo:before{
  content: "";
  position: absolute;
  top: 5px;
  left: 5px;
  width: 90px;
  height: 90px;
  background: #2196F3;
  border-radius: 50%;
}

.payment-logo p{
  position: relative;
  color: #f8f8f8;
  font-family: 'Baloo Bhaijaan', cursive;
  font-size: 58px;
}

input[type=submit] {
	background-color: #2196F3;
	border: none;
	color: #f8f8f8;
	font-size: 16px;
}

@media screen and (max-width: 420px){
  .card-grp{
    flex-direction: column;
  }
  .card-item{
    width: 100%;
    margin-bottom: 20px;
  }
  .btn{
    margin-top: 20px;
  }
}
</style>
</head>
<body>
<?php
include("../Assets/Connection/Connection.php");
include("SessionValidator.php");
include('../email.php');

if(isset($_POST["btnpay"])){
    
    $status = 4; # 4 means vacated

    $updateQry = "UPDATE tbl_student SET verification_status='$status' WHERE user_id='" . $_GET["vid"] . "'";
    $con->query($updateQry);

    $updateParentQry = "UPDATE tbl_parent SET verification_status='$status' WHERE student_id='" . $_GET["vid"] . "'";
    $con->query($updateParentQry);

    $updateRoomQry = "UPDATE tbl_room SET no_of_occupants=no_of_occupants-1 WHERE room_id='" . $_GET["rid"] . "'";
    $con->query($updateRoomQry);

    $deleteQry = "DELETE FROM tbl_roompreference WHERE user_id='" . $_GET["vid"] . "'";
    $con->query($deleteQry);

    //Email Start
    $selStudent="select * from tbl_student s inner join tbl_user u on s.user_id=u.user_id where s.user_id='".$_GET["vid"]."'";
    $rowSelStudent=$con->query($selStudent);
    $dataSelStudent=$rowSelStudent->fetch_assoc();

    $recipientEmail= $dataSelStudent["user_email"];
    $subject="Vacated";

    $message = "Dear " . $dataSelStudent["student_firstname"] . " " . $dataSelStudent["student_middlename"] . " " . $dataSelStudent["student_lastname"] . ",<br>";
    $message .= "<br>Your caution deposit of 3000 has been returned.<br><br>Vacating process has been completed.<br><br>You are not able to login your account from now.<br><br>";
    $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
    $message .= "Thank You for choosing us.";

    sendEmail($recipientEmail,$subject,$message);
    //Email End

    ?>
      <script>
        alert("Payment Success");
        alert("Student Vacated");
      </script>
    <?php
    
}
?>
   
    <br><br><br><br>
<!-- partial:index.partial.html -->
<jsp:useBean class="DB.ConnectionClass" id="con"></jsp:useBean>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">

<div class="wrapper">
  <div class="payment">
    <div class="payment-logo">
      <p>p</p>
    </div>
    
      <form method="post">
    <h2>Payment Gateway</h2>
    <div class="form">
      <div class="card space icon-relative">
        <label class="label">Card holder:</label>
        <input type="text" name="txtname" class="input" placeholder="Card Holder" autocomplete="off" required="required" title="Name Allows Only Alphabets,Spaces " pattern="^[a-zA-Z ]*$">
        <i class="fas fa-user"></i>
      </div>
      <div class="card space icon-relative">
        <label class="label">Card number:</label>
        <input type="text" class="input" name="txtcard" id="txtcard"  placeholder="Card Number" maxlength="19" pattern="\d{4} \d{4} \d{4} \d{4}"  autocomplete="off" required="required"  title="16 digit with 0-9">
        <i class="far fa-credit-card"></i>
      </div>
      <div class="card-grp space">
        <div class="card-item icon-relative">
          <label class="label">Expiry date:</label>
          <input type="text" name="expiry-data" class="input" data-mask="00 / 00" placeholder="00 / 00" autocomplete="off" required="required">
          <i class="far fa-calendar-alt"></i>
        </div>
        <div class="card-item icon-relative">
          <label class="label">CCV:</label>
          <input type="text" class="input" name="txtccv" pattern="[0-9]{3}" placeholder="000" maxlength="3" autocomplete="off" required="required">
          <i class="fas fa-lock"></i>
        </div>
      </div>
        
        
      <div class="btn">
      	
        <input type="submit" name="btnpay" id="btnpay" value="Pay"> 
      </div> 
      
    </div>
      </form>
  </div>
  <!-- Back Button -->
  <button class="btn btn-dark btn-rounded btn-icon back-button" onclick="goBack()">⬅</button>
                     
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js'></script>

</body>

</html>
<script>
        document.getElementById('txtcard').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters
            value = value.substring(0, 16); // Limit to 16 digits

            // Add spaces after every 4 digits
            let formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();

            e.target.value = formattedValue;
        });

   
function goBack() {
    window.history.back();
}

</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment</title>

<link rel="shortcut icon" href="../Assets/Template/Warden/images/Logo.png" />
</head>

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
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");
include('../email.php');

if(isset($_POST["btnpay"])){
    $updateMess="update tbl_messfee set payment_status=1,payed_date=curdate() where messfee_id='".$_GET["messfeeid"]."'";
    $con->query($updateMess);

    $updateHostelRent="update tbl_hostelrentpayment set payment_status=1 where rent_id='".$_GET["rentid"]."'";
    $con->query($updateHostelRent);

    //Email Start
    $selStudent="select * from tbl_student s inner join tbl_user u on s.user_id=u.user_id where s.user_id='".$_SESSION["user_id"]."'";
    $rowSelStudent=$con->query($selStudent);
    $dataSelStudent=$rowSelStudent->fetch_assoc();

    $selMessFee="select * from tbl_messfee where messfee_id='".$_GET["messfeeid"]."'";
    $rowMessFee=$con->query($selMessFee);
    $dataMessFee=$rowMessFee->fetch_assoc();

    $recipientEmail= $dataSelStudent["user_email"];
    $subject="Bill Payed";

    $message = "Dear " . $dataSelStudent["student_firstname"] . " " . $dataSelStudent["student_middlename"] . " " . $dataSelStudent["student_lastname"] . ",<br>";
    $message .= "<br>Bill for ".date("F", mktime(0, 0, 0, $dataMessFee["month"], 1, date("Y")))." ".$dataMessFee["year"]." payed.<br><br>";
    $message .= "For any assistance, feel free to contact us at <a href='mailto:hmshostel@gmail.com'>hmshostel@gmail.com</a>.<br><br>";
    $message .= "Thank You.";

    sendEmail($recipientEmail,$subject,$message);
    //Email End

    ?>
      <script>
        alert("Payment Success");
        window.location="viewPreviousBills.php";
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
    </script>


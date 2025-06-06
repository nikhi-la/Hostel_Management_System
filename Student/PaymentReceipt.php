<!DOCTYPE html>
<html>
	<head>
		<style>
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}

*{
	font-family: arial;
}
.invoice_container{
	padding: 10px 10px;
}
.invoice_header{
	display: flex;
	justify-content: space-between;
	width: 100%;
	background: #e7c9c9;
}
button{
	background: #e7c9c9;
}
.logo_container{
	margin-top: auto;
	margin-bottom: auto;
	margin-left: 10px;
}
.company_address{
	margin-right: 10px;
}
.invoice_header h2{
	margin-bottom: 0;
}
.invoice_header p{
	margin-top: 10px;
}
.logo_container img{
	height: 60px;
}
.customer_container{
	padding: 0 10px;
	display: flex;
	justify-content: space-between;
}
.customer_container h2{
	margin-bottom: 10px;
}
.customer_container h4{
	margin-bottom: 10px;
	margin-top: 0;
}
.customer_container p{
	margin: 0;
}
.in_details{
	margin-top: auto;
	margin-bottom: auto;
}
.product_container{
	padding: 0 10px;
	margin-top: 10px;
}
.item_table{
	width: 100%;
    text-align: left;
}
.item_table td,th{
	padding: 5px 10px;
}
.invoice_footer{
	padding: 0 10px;
	display: flex;
	justify-content: space-between;
}
.invoice_footer h2{
	margin-bottom: 10px;
}
.note{
	width: 50%;
}
.invoice_footer_amount{
	margin: auto 0;
	background: #e7c9c9;
}
.amount_table td,th{
	padding: 5px 10px;
}
.in_head{
    margin: 0;
    text-align: center;
    background: #e7c9c9;
    padding: 5px;
}

		</style>
	</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Invoice</title>
</head>
<body>
<?php
include("SessionValidator.php");
include("../ASSETS/Connection/Connection.php");
if(isset($_GET["pid"]))
{
	$_SESSION["pid"]=$_GET["pid"];
}
$curdate = date('d-m-y');

$sel="select * from tbl_student s inner join tbl_user u on s.user_id=u.user_id where s.user_id='".$_SESSION["user_id"]."'";
$row=$con->query($sel);
$data=$row->fetch_assoc();

$selMess="select * from tbl_messpayment mp where messpayment_id=1";
$rowMess=$con->query($selMess);
$dataMess=$rowMess->fetch_assoc();

$selHostel="select * from tbl_hostelrentpayment rp where rent_id=1";
$rowHostel=$con->query($selHostel);
$dataHostel=$rowHostel->fetch_assoc();

if($dataMess["payment_status"]==1)
{
?>
<page size="A4">
	<div class="invoice_container">
		<div class="invoice_header">

			  <img src="Sd.png" width="180" height="180">
		  <div class="company_address">
				<h2>HMS</h2>
				<p>
					Ernakulam<br>
					Perumbavoor <br>
					+91 9745620479 <br>
                    hmshostel@gmail.com
				</p>
			</div>
		</div>
		<div class="customer_container">
			<div>
				<h2>Billing To</h2>
				<h4><?php echo ucfirst($data["student_firstname"]);?> <?php echo ucfirst($data["student_middlename"]);?> <?php echo ucfirst($data["student_lastname"])?> </h4>
				<p>
              <?php echo ucfirst($data["student_housename"]);?><br>
		 	  <?php echo ucfirst($data["student_city"]);?><br>
		 	  <?php echo ucfirst($data["student_district"]);?><br>
        	  <?php echo ucfirst($data["district_country"]);?><br>
        	  <?php echo $data["student_pincode"]?><br>
              +91 <?php echo $data["student_contact"];?><br>
              <?php echo $data["user_email"];?><br>
  				</p>
			</div>
			<div class="in_details">
				<h1 class="in_head">INVOICE</h1>
				<table>
					<tr>
						<td>Invoice No</td>
						<td>:</td>
						<td><b><?php echo "RN".$data["user_id"]; ?></b></td>
					</tr>
					<tr>
						<td>Date</td>
						<td>:</td>
						<td><b><?php echo $curdate; ?></b></td>
					</tr>

			  </table>
			</div>
		</div>
		<div class="product_container">
			<table width="83%" border="1" cellspacing="0" class="item_table">
				<tr>
					<th width="74%">DESCRIPTION</th>
					<th width="26%">AMOUNT ( in INR )</th>
				</tr>
				<tr>
                   <td><p>Mess Amount :<?php echo $dataMess["common_expense"]+$dataMess["veg_expense"]+$dataMess["nonveg_expense"]; ?></p>
                    <p>Hostel Rent :<?php echo $dataHostel["room_rent"]; ?></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p></td>
					<td><p><?php
					$total=$dataMess["common_expense"]+$dataMess["veg_expense"]+$dataMess["nonveg_expense"]+$dataHostel["room_rent"];
					 echo $total; ?> INR</p>
				    <p><?php 
					$words=displaywords($total);
					echo $words; ?></p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p>
				    <p>&nbsp;</p></td>
				</tr>
			</table>
		</div>
	
				<h2 align="center">Thank You!</h2>
				
            <p align="center">If you have any questions about this invoice,please contact </p>
            <p align="center">Smart Drive,+91 9745620479,smartdrive46@gmail.com</p>
				
			</div>
            </page>
         
          <center>
            <button  id="printpagebutton" onClick="javascript:printReceipt();">Download</button>
          </center>
<?php
}
else
{       ?>
        <script>
        alert("Invalid Invoice");
        </script>
        <?php
}

function displaywords($number){
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;


     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
	$result=ucfirst($result);

  $points = ($point) ?
    "" . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : ''; 
	$points=ucfirst($points);

  if($points != ''){        
  echo $result . "Rupees  " . $points . " Paise Only";
} else {

    echo $result . "Rupees Only";
}

}

?>

</body>
</html>
<script src="../Assets/Jquery/jQuery.js"></script>
<script>
    function printReceipt(){
	    var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
		window.print() ;
    };
	
</script>
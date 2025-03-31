<?php
session_start();
include("../Assets/Connection/Connection.php");
//echo $_SESSION["user_id"].$_SESSION["user_type"];

if(isset($_SESSION["user_id"]) && ($_SESSION["user_type"]=="student") )
{
	$sel="select * from tbl_student where user_id='".$_SESSION["user_id"]."'";
	$row = $con->query($sel);
	$data = $row->fetch_assoc();
	//echo $data['caution_deposit_status'];
	if($data['verification_status']==1 || $data['verification_status']==3){
		if($data['caution_deposit_status']!=1){
			?>
				<script>
					alert("Pay caution deposit");
					window.location="payCautionDeposit.php";
				 </script>
			<?php
			}
	
	}else{
		?>
		<script>
            alert("Not Verified");
            window.location="../index.php";
		 </script>
	<?php
	}
	
}
else
{
	
	?>
		<script>
            alert("Please Login");
            window.location="../Login.php";
		 </script>
	<?php
	
}
?>
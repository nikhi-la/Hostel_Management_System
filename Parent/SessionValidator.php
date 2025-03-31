<?php
session_start();
include("../Assets/Connection/Connection.php");
//echo $_SESSION["user_id"].$_SESSION["user_type"];

if(isset($_SESSION["user_id"]) && ($_SESSION["user_type"]=="parent") )
{
	$sel="select verification_status from tbl_parent where user_id='".$_SESSION["user_id"]."'";
	$row = $con->query($sel);
	$data = $row->fetch_assoc();
	//echo $data['verification_status'];
	if($data['verification_status']==1 || $data['verification_status']==3){

	}
	else{
	?>
		<script>
            alert("Invalid User");
            window.location="../Login.php";
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
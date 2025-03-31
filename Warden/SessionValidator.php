<?php
session_start();

//Due update

$sel="select * from tbl_messfee where payment_status=0";
$row = $con->query($sel);
if(mysqli_num_rows($row)>0){
	
	while($data = $row->fetch_assoc()){
		
		$added_date = strtotime($data["added_date"]); // Convert expense_date to timestamp
		$current_date = strtotime(date('Y-m-d')); // Get current date in correct format

		if ($added_date === false) {
			die("Invalid date format for expense_date.");
		}

		$diff = ($current_date - $added_date) / (60 * 60 * 24); // Convert seconds to days
		
		if ($diff > 10) {
			$due = 100 * (intval($diff / 10));
			$update="update tbl_messfee set due_amount=$due where messfee_id='".$data["messfee_id"]."' ";
			$con->query($update);
		}
	}
}




if($_SESSION["user_id"]==null || $_SESSION["user_type"]!="warden")
{
	?>
		<script>
            alert("Unauthorized Access");
            window.location="../Login.php";
		 </script>
	<?php
}
?>
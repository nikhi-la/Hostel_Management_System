<?php
include("../Assets/Connection/Connection.php");

// Get room capacity from AJAX request
if (isset($_GET['capacity']) && isset($_GET['type'])) {
    $capacity = intval($_GET['capacity']); // Ensure it's an integer
    $type = intval($_GET['type']);
        // Fetch rent value from the database
        $sql = "SELECT room_amount FROM tbl_roomtype WHERE room_share = $capacity and room_type= $type"; // Use backticks for column name
        $result = $con->query($sql);

        if ($row = $result->fetch_assoc()) {
            echo $row["room_amount"]; // Return the rent value
        } else {
            echo "Not Found"; // If no data found
        }
    } else {
        echo "Invalid Capacity or room type"; // If capacity is out of range
    }

?>

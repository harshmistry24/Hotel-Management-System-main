<?php
include("db_connect.php");

// Fetch rent from the database
$query = "SELECT banquet_price FROM banquet_dining_set WHERE id = 1";
$result = $conn->query($query);

if ($row = $result->fetch_assoc()) {
    echo $row["banquet_price"]; // Output the rent value
} else {
    echo "Error";
}
$conn->close();
?>

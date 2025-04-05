<?php
include '../db_connect.php';

$query = "SELECT date, days FROM banquet";
$result = $conn->query($query);

$bookedDates = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $startDate = new DateTime($row['date']);
        $days = intval($row['days']);

        for ($i = 0; $i < $days; $i++) {
            $date = clone $startDate;
            $date->modify("+$i days");
            $bookedDates[] = $date->format('Y-m-d');
        }
    }
}

echo json_encode($bookedDates);
$conn->close();
?>

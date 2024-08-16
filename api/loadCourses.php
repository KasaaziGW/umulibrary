<?php
include('dbconfig.php');
// Fetch courses from the database
$sql = "SELECT id, name, code FROM courses ORDER BY name";
$result = $conn->query($sql);

$courses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

$conn->close();

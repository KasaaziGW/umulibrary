<?php
include("dbconfig.php");
// Get course id from POST request
$course_id = intval($_POST['course_id']);

// Fetch course units based on course id
$query = $conn->prepare("SELECT DISTINCT cu.id, cu.name, cu.code FROM course_units cu JOIN course_course_units ccu ON cu.id = ccu.course_unit JOIN courses c ON ccu.course = c.id WHERE c.id = ? ORDER BY cu.name");
$query->bind_param("i", $course_id);
$query->execute();
$result = $query->get_result();

// Generate options for the units combo box
$options = '';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row['id'] . '">' . $row['name'] . ' - ' . $row['code'] . '</option>';
}

// Output options
echo $options;

// Close connection
$query->close();
$conn->close();

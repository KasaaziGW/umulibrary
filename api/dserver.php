<?php
include('sessions.php');
// Suppress errors
error_reporting(0);
include("dbconfig.php");
$errors = array();
$messages = array();

// function to replace spaces with underscores in the course_unit name 
function replaceSpacesWithUnderscore($text)
{
    // Replace spaces with underscores
    $text = str_replace(' ', '_', $text);

    // Append an underscore at the end
    return $text . '_';
}

// function to convert date formats from mm/dd/yyyy to yyyy-mm-dd
function convertDateFormat($date)
{
    // Create a DateTime object from the input date
    $dateObject = DateTime::createFromFormat('m/d/Y', $date);

    // Return the date in the desired format
    return $dateObject->format('Y-m-d');
}

// saving the exam
if (isset($_POST['saveDetails'])) {
    // receive all input values from the form
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $course_unit = mysqli_real_escape_string($conn, $_POST['course_unit']);
    $yr = mysqli_real_escape_string($conn, $_POST['year']);
    $sem = mysqli_real_escape_string($conn, $_POST['semester']);
    $campus = mysqli_real_escape_string($conn, $_POST['campus']);
    $edate = mysqli_real_escape_string($conn, $_POST['exam_date']);

    $details = explode("-", $course_unit);
    $cuid = $details[0];
    $cu_name = $details[1];
    $sid = $id;

    // add '-' to the name
    $new_name = replaceSpacesWithUnderscore($cu_name);
    // formatting the date
    $date = convertDateFormat($edate);
    // concatenating the new name and the date.
    $new_name .= $date;
    // File upload handling
    $file = $_FILES['exam'];
    $fileSize = $file['size'];

    // Define the target directory for file upload
    $targetDir = "past_papers/";
    $targetFilePath = $targetDir . $new_name . '.pdf';

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        $query = "INSERT INTO exams (filename, type, size, caption, date, campus, staffid) VALUES('$new_name', 'application/pdf', '$fileSize', '$cu_name', '$date', '$campus', '$sid')";
        // mysqli_query($conn, $query);

        // Execute the query
        if ($conn->query($query) === TRUE) {
            // Get the last inserted ID
            $exam_id = $conn->insert_id;
            $cquery = "INSERT INTO exam_course_units (exam_id, course_unit_id) VALUES('$exam_id', '$cuid')";
            mysqli_query($conn, $cquery);
            array_push($messages, "New Paper has been successfully uploaded");
        } else {
            array_push($errors, "Error: " . $conn->error);
        }
    } else {
        array_push($errors, "Sorry, there was an error while uploading your file.");
    }
    header("Refresh: 5, URL=./addpapers.php");
}

$conn->close();

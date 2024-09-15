<?php
// Suppress errors
error_reporting(0);
include("dbconfig.php");
$errors = array();
$messages = array();
// creating account
if (isset($_POST['saveCourse'])) {
    // receive all input values from the form
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $details = explode("-", $course);
    $cid = $details[0];
    $pg = $details[1];
    $uid = $details[2];

    $sql = "SELECT * FROM users_course WHERE uid = '$uid'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    if (empty($user['uid'])) {
        $query = "INSERT INTO users_course (cid, uid) VALUES('$cid', '$uid')";
        mysqli_query($conn, $query);
        array_push($messages, "Selected course has successfully been saved.");
    } else {
        $query = "UPDATE users_course SET cid = '$cid' WHERE uid = '$uid'";
        mysqli_query($conn, $query);
        array_push($messages, "Selected course has successfully been updated.");
    }
    if ($pg == "index") header("Refresh: 3, URL=./index.php");
    else header("Refresh: 3, URL=./selectCourse.php");
}

if (isset($_POST['updateDetails'])) {
    // receive all input values from the form
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $cu = mysqli_real_escape_string($conn, $_POST['credit_unit']);
    $yr = mysqli_real_escape_string($conn, $_POST['year']);
    $sem = mysqli_real_escape_string($conn, $_POST['semester']);
    $query = "UPDATE course_units SET name = '$name', code = '$code', credit_unit = '$cu', year = '$yr', semester = '$sem' WHERE id = '$id'";
    mysqli_query($conn, $query);
    array_push($messages, "Course Unit details have successfully been updated.");
    header("Refresh: 3, URL=./coursedetails.php");
}

// adding a new course
if (isset($_POST['saveNewCourse'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $cat = mysqli_real_escape_string($conn, $_POST['category']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $query = "INSERT INTO courses (name, code, category, duration) VALUES('$name', '$code', '$cat','$duration')";
    mysqli_query($conn, $query);
    array_push($messages, "New Course details have successfully been added.");
    header("Refresh: 3, URL=./newcourse.php");
}

// adding a new course unit
if (isset($_POST['saveCourseUnits'])) {
    // receive all input values from the form
    $cid = mysqli_real_escape_string($conn, $_POST['course']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $cu = mysqli_real_escape_string($conn, $_POST['credit_unit']);
    $yr = mysqli_real_escape_string($conn, $_POST['year']);
    $sem = mysqli_real_escape_string($conn, $_POST['semester']);
    $query = "INSERT INTO course_units(name, code, credit_unit, year, semester) VALUES('$name', '$code', '$cu','$yr', '$sem')";
    if ($conn->query($query) === TRUE) {
        // Get the last inserted ID
        $cuid = $conn->insert_id;
    }
    $cquery = "INSERT INTO course_course_units (course, course_unit) VALUES('$cid', '$cuid')";
    mysqli_query($conn, $cquery);
    array_push($messages, "The Course Unit details have successfully been saved.");
    header("Refresh: 3, URL=./addcourseunit.php");
}
$conn->close();

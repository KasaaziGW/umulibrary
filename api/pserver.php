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
    else header("Refresh: 3, URL=./addCourse.php");
}

$conn->close();

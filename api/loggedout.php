<?php
include("sessions.php");
include("./dbconfig.php");
$update = "UPDATE users SET status = 0 WHERE uid='$id'";
mysqli_query($conn, $update);

// Unset the session variable
unset($_SESSION['eid']);
unset($_SESSION['fullname']);
unset($_SESSION['role']);
unset($_SESSION['pp']);
unset($_SESSION['username']);

// Destroy the session
session_destroy();
// show message upon logging out
// array_push($messages, "You have been successfully logged out .");
// array_push($errors, "You have been successfully logged out .");

// Redirect to the index page
header('Location: ../index.php');
exit;

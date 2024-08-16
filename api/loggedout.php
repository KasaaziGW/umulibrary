<?php
include("./sessions.php");
include("./dbconfig.php");
if ($role == 'admin' || $role == 'librarian') {
    $updateStaff = "UPDATE staff SET status = 0 WHERE uid='$id'";
    mysqli_query($conn, $updateStaff);
    $userlog = "INSERT INTO userlog(uid, role, activity) VALUES ('$id','$role', 'Logged out')";
    mysqli_query($conn, $userlog);
} else {
    $updateUser = "UPDATE users SET status = 0 WHERE uid='$id'";
    mysqli_query($conn, $updateUser);
    $userlog = "INSERT INTO userlog(uid, role, activity) VALUES ('$id','$role', 'Logged out')";
    mysqli_query($conn, $userlog);
}

// Unset the session variable
unset($_SESSION['user']);

// Destroy the session
session_destroy();

// Redirect to the index page
header('Location: ../index.php');
exit;

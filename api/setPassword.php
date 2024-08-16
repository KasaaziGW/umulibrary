<?php
// Suppress errors
error_reporting(0);
include("dbconfig.php");
$errors = array();
$messages = array();

if (isset($_POST['savePassword'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $password = md5($password_1); //encrypt the password before saving in the database
    if (count($errors) == 0) {
        $query = "UPDATE users SET password='$password' WHERE email = '$email' OR uid = '$id'";
        mysqli_query($conn, $query);
        // array_push($messages, "Password Successfully updated.");
        header("Refresh: 5, url=./index.php");
    }
}

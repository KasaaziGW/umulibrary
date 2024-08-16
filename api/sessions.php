<?php
if (session_status() == 1) session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userInfo = explode(" ", $user['name']);
    $picName = $user['fileName'];
    $role = $user['role'];
    $id = $user['id'];
    // $fname = explode(" ", $_SESSION['fullname']);
    // $staff = $_SESSION['fullname'];
    // $id = $_SESSION['eid'];
    // $role = $_SESSION['role'];
    // $pic = $_SESSION['pp'];
    // $branch = $_SESSION['branch'];
    // } else if (isset($_SESSION['user'])) {
    //     $user = $_SESSION['user'];
} else {
    header('location: ../index.php');
}

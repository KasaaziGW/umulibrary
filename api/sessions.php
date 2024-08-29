<?php
if (session_status() == 1) session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userInfo = explode(" ", $user['name']);
    $picName = $user['fileName'];
    $role = $user['role'];
    $id = $user['id'];
    if (isset($user['email'])) $email = $user['email'];
} else {
    header('location: ../index.php');
}

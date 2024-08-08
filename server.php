<?php
// importing the database configurations
include("./api/dbconfig.php");

// initializing variables
$errors = array();
$messages = array();
// LOGIN USER
if (isset($_POST['userlogin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM staff WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $uid = $user['uid'];
            $role = $user['role'];
            $accountstatus = $user['accstatus'];
            // checking if the user's account is inactive or not
            if ($accountstatus == 0) {
                array_push($errors, "Your account was suspended!");
                array_push($errors, "Contact the system administrator for help.");
            } else {
                // updating the user's login status
                $update = "UPDATE staff SET status=1 WHERE uid='$uid'";
                mysqli_query($conn, $update);
                // adding the user's details in the userlog table
                $userlog = "INSERT INTO userlog(uid, role, activity) VALUES ('$uid','$role', 'Logged in')";
                mysqli_query($conn, $userlog);
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['role'] = $role;
                $_SESSION['eid'] = $uid;
                $_SESSION['pp'] = $user['photo'];
                $_SESSION['branch'] = $user['branch'];
                header('location: ./api/index.php');
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

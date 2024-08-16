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
        $hashedPassword = md5($password);
        $query = "SELECT * FROM staff WHERE username='$username' AND password='$hashedPassword'";
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
                // Store user info in an object
                $staff = [
                    'id' => $uid,
                    'username' => $username,
                    'name' => $user['fullname'],
                    'addPassword' => 'No',
                    'fileName' => $user['photo'],
                    'role' => $role
                ];
                // Encode the user data
                $encodedUserData = base64_encode(json_encode($staff));
                // Redirect to index.php with the encoded user data as a parameter
                header('location: ./api/index.php?data=' . urlencode($encodedUserData));
            }
        } else {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE email='$username' AND password='$password'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $uid = $user['uid'];
                $role = "user";
                // updating the user's login status
                $update = "UPDATE users SET status=1 WHERE uid='$uid'";
                mysqli_query($conn, $update);
                $userlog = "INSERT INTO userlog(uid, role, activity) VALUES ('$uid','$role', 'Logged in')";
                mysqli_query($conn, $userlog);
                // Store user info in an object
                $oldUser = [
                    'id' => $uid,
                    'name' => $user['fullname'],
                    'addPassword' => 'No',
                    'fileName' => $user['photo'],
                    'role' => $role
                ];
                // Encode the user data
                $encodedUserData = base64_encode(json_encode($oldUser));
                // Redirect to index.php with the encoded user data as a parameter
                header('location: ./api/index.php?data=' . urlencode($encodedUserData));
            } else {
                array_push($errors, "Wrong username/password combination!");
                array_push($errors, "Consider signing in with your umu email and either set or reset your password.");
            }
        }
    }
}

<?php
// Suppress errors
error_reporting(0);
include("dbconfig.php");
$errors = array();
$messages = array();
// creating account
if (isset($_POST['saveDetails'])) {
    // receive all input values from the form
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($fullname) || empty($username) || empty($password_1) || empty($password_2)) {
        array_push($errors, "All the above fields are required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match!");
    }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM staff WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists!");
        }
    }

    // dealing with the image upload
    if (isset($_FILES['imgload']) && $_FILES['imgload']['error'] == 0) {
        $fileName = $_FILES['imgload']['name'];
        // removing the file extension to check for allowed image types
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'bmp', 'png');
        if (in_array($fileActualExt, $allowed) == false) {
            array_push($errors, "You cannot upload files of this type!");
        } else {
            // preparing the Image for Saving
            $fileNameNew = trim($username) . "." . $fileActualExt;
            $fileTempName = $_FILES['imgload']['tmp_name'];
            $fileDestination = './pics/' . $fileNameNew;
            move_uploaded_file($fileTempName, $fileDestination);
            $image = $fileNameNew;
        }
    } else {
        $image = "default.jpg";
    }
    // array_push($errors, $image . ", " . $_FILES['imgload'] . ", " . $_FILES['imgload']['error']);
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database
        $query = "INSERT INTO staff (fullname, username, branch, password, photo, role) VALUES('$fullname', '$username', '$branch','$password', '$image', '$role')";
        mysqli_query($conn, $query);
        array_push($messages, "Account successfully created.");
        header("Refresh: 5, URL=./register.php");
    }
}

// updating account
if (isset($_POST['updateDetails'])) {
    // receive all input values from the form
    $id = mysqli_real_escape_string($conn, $_POST['eid']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($fullname) || empty($username)) {
        array_push($errors, "All the above fields are required");
        header("Refresh: 5, URL=./viewusers.php");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match!");
        header("Refresh: 5, URL=./viewusers.php");
    }

    // dealing with the image upload
    // variable storing image path
    $image = '';
    if (isset($_FILES['imgload']) && $_FILES['imgload']['error'] == 0) { // 
        $fileName = $_FILES['imgload']['name'];
        // removing the file extension to check for allowed image types
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'bmp', 'png');
        if (in_array($fileActualExt, $allowed) == false) {
            array_push($errors, "You cannot upload files of this type!");
        } else {
            // preparing the Image for Saving
            $fileNameNew = trim($username) . "." . $fileActualExt;
            $fileTempName = $_FILES['imgload']['tmp_name'];
            $fileDestination = './pics/' . $fileNameNew;
            move_uploaded_file($fileTempName, $fileDestination);
            $image = $fileNameNew;
        }
    }

    // Finally, update user details if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        // Update the staff record in the database
        if (!empty($image)) {
            // If a new image was uploaded, update the image field
            $query = "UPDATE staff SET fullname = '$fullname', username = '$username', branch = '$branch', photo = '$image', role = '$role'";
        } else {
            // If no new image was uploaded, update only the name
            $query = "UPDATE staff SET fullname = '$fullname', username = '$username', branch = '$branch', role = '$role'";
        }
        if (!empty($password_1)) {
            $query .= ", password = '$password'";
        }
        $query .= " WHERE uid='$id'";
        // array_push($errors, "Query: {$query}");

        if ($conn->query($query) === TRUE) {
            array_push($messages, "Account successfully updated.");
        } else {
            array_push($errors, "Error: " . $query . "<br>" . $conn->error);
            // $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }

        // redirecting to the 'viewusers' page
        header("Refresh: 0; URL=./viewusers.php");
        // mysqli_query($conn, $query);
        // header('location: ./viewusers.php');
    }
}


// activating/deactivating the account
if (isset($_GET['did'])) {
    $useraction = explode(" ", $_GET['did']);
    $id = $useraction[1];
    $action = $useraction[0];
    $status = $action == "Activate" ? "1" : "0";
    $query = "UPDATE users SET accstatus='$status' WHERE uid='$id'";
    mysqli_query($conn, $query);
    array_push($messages, 'Account successfully' . strtolower($action) . 'd');
    header('location: ./viewusers.php');
}

$conn->close();

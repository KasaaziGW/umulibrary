<?php
require_once './config.php';
try {
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // Get user info
        $oauth2 = new Google\Service\Oauth2($client);
        $userinfo = $oauth2->userinfo->get();

        // assigning the user info to variables
        $email = $userinfo->getEmail();
        $id = $userinfo->getId();
        $fullname = $userinfo->getName(); // Full name
        $picture = $userinfo->getPicture();
        // importing the database configurations
        include("./api/dbconfig.php");
        // initializing variables
        $errors = array();
        $messages = array();
        $query = "SELECT uid, password, photo FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        // if the user (student or staff) exists, check if they have a password or not.
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $pic = $user['photo'];
            if (empty($user['password'])) {
                // if the password is empty, user has to set their password upon log in.
                // Store user info in an object
                $user = [
                    'id' => $user['uid'],
                    'email' => $email,
                    'name' => $fullname,
                    'picture' => $picture,
                    'addPassword' => 'Yes',
                    'fileName' => $pic,
                    'role' => 'user'
                ];
            } else {
                // if the password is not empty, proceed normally.
                // Store user info in an object
                $user = [
                    'id' => $user['uid'],
                    'email' => $email,
                    'name' => $fullname,
                    'picture' => $picture,
                    'addPassword' => 'No',
                    'fileName' => $pic,
                    'role' => 'user'
                ];
            }
        } else {
            // adding the new user to the database, since they don't exist.
            // downloading the image and preparing it for saving into the database
            // Get the contents of the image
            $image_data = file_get_contents($picture);

            // Generate a filename based on the user's email
            $emailInfo = explode('@', $email);
            $image_filename = $emailInfo[0] . '.jpg'; // You could use other extensions like '.png' depending on the image type

            // Define the directory where you want to save the image
            $save_path = './api/pics/' . $image_filename;

            // Save the image to the "pics" directory
            file_put_contents($save_path, $image_data);

            $newUser = "INSERT INTO users(fullname, email, photo) VALUES ('$fullname','$email', '$image_filename')";
            // mysqli_query($conn, $newUser);
            if ($conn->query($newUser) === TRUE) {
                // Get the last inserted ID
                $uid = $conn->insert_id;
                // array_push($messages, "Account successfully updated.");
                // Store user info in an object
                $user = [
                    'id' => $uid,
                    'email' => $email,
                    'name' => $fullname,
                    'picture' => $picture,
                    'addPassword' => 'Yes',
                    'fileName' => $image_filename,
                    'role' => 'user'
                ];
            } else {
                array_push($errors, "Error: " . $query . "<br>" . $conn->error);
                // $error_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Encode the user data
        $encodedUserData = base64_encode(json_encode($user));
        // Redirect to index.php with the encoded user data as a parameter
        header('location: ./api/index.php?data=' . urlencode($encodedUserData));

        exit();
    }
} catch (Exception $e) {
    array_push($errors, htmlspecialchars($e->getMessage()));
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}

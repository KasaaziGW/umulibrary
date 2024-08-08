<?php
require_once './config.php';
// print_r($_SESSION);
// exit();
// require_once './google-api-php-client/src/Google_Client.php';
// require_once './google-api-php-client/src/Google_Service_Oauth2.php';
try {
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // Get user info
        $oauth2 = new Google\Service\Oauth2($client);
        $userinfo = $oauth2->userinfo->get();

        // Store user info in session or database
        $newUser = [
            'id' => $userinfo->getId(),
            'email' => $userinfo->getEmail(),
            'name' => $userinfo->getName(), // Full name
            'givenName' => $userinfo->getGivenName(),
            'familyName' => $userinfo->getFamilyName(),
            'picture' => $userinfo->getPicture()
        ];
        // Encode the user data using base64
        $encodedUserData = base64_encode(json_encode($newUser));
        // Debug: Print the encoded data
        // echo "Encoded Data: " . htmlspecialchars($encodedUserData);
        // exit();
        // Redirect to index.php with the encoded user data as a parameter

        header('location: ./api/index.php?data=' . urlencode($encodedUserData));

        exit();
    }
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}

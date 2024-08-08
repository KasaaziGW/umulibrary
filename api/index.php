<?php
if (isset($_GET['data'])) {
    // Decode the base64 encoded user data
    $encodedUserData = $_GET['data'];
    $decodedUserData = json_decode(base64_decode($encodedUserData), true);
    $user = $decodedUserData;
} else {
    echo "<p>No user data received.</p>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
</head>

<body>
    <?php if ($user) : ?>
        <h1>Welcome, <?php echo $user['name']; ?></h1>
        <p>Email: <?php echo $user['email']; ?></p>
        <img src="<?php echo $user['picture']; ?>" alt="Profile Picture">
    <?php else : ?>
        <p>Failed to decode user data</p>
    <?php endif ?>
</body>

</html>
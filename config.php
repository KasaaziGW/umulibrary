<?php
require_once './google-api-php-client/vendor/autoload.php';

$client = new Google\Client();
$client->setClientId('316690405852-aej65uluon8d338krc74ho9ibt36uu12.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/umulibrary/callback.php');
$client->addScope('email');
$client->addScope('profile');

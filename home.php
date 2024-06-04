<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google LogIn Success</title>

    <link rel="shortcut icon" href="https://cdn.worldvectorlogo.com/logos/google-cloud-1.svg" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <?php

    echo 'Hola Mundo!';

    require_once 'config.php';

    echo 'Hola Config!';

    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {

        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        echo "<pre>";
        print_r($google_account_info);

    ?>
        <h1>This is Home <code>With</code> Code</h1>
    <?php
    }
    ?>
</body>

</html>

<?php

// require_once 'config.php';

// // authenticate code from Google OAuth Flow
// if (isset($_GET['code'])) {
//     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//     $client->setAccessToken($token['access_token']);

//     // get profile info
//     $google_oauth = new Google_Service_Oauth2($client);
//     $google_account_info = $google_oauth->userinfo->get();
//     $email =  $google_account_info->email;
//     $name =  $google_account_info->name;

//     // now you can use this profile info to create account in your website and make user logged in.
// } else {
//     echo "<a href='" . $client->createAuthUrl() . "' class='btn btn-outline-danger col-12 mt-4'><i class='bi bi-google'></i>&nbsp;&nbsp;SignIn With Google</a>";
// }
?>
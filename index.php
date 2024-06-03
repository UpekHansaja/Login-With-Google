<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google LogIn Test App</title>

    <link rel="shortcut icon" href="https://cdn.worldvectorlogo.com/logos/google-cloud-1.svg" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="vh-100 d-flex align-items-center justify-content-center flex-column">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-center flex-column">
                <div class="row d-flex flex-column">
                    <img src="https://cdn.worldvectorlogo.com/logos/google-cloud-1.svg" alt="GCloud Logo - Google LogIn" height="80">
                    <h1 class="text-center">Google LogIn</h1>
                    <h3 class="text-center">Test App</h3>
                </div>
                </br>
                <div class="row px-3">
                    <div class="col-12 col-md-6 col-lg-4 offset-0 offset-md-3 offset-lg-4">
                        <div class="row">

                            <div class="col-12">
                                <div class="row p-0">
                                    <div class="col-6">
                                        <div class="row pe-1">
                                            <label for="fname" class="form-label">First Name</label>
                                            <input type="text" class="form-control col-12 mb-2" placeholder="First Name" id="fname">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row ps-1">
                                            <label for="lname" class="form-label">Last Name</label>
                                            <input type="text" class="form-control col-12 mb-2" placeholder="Last Name" id="lname">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control col-12 mb-2" placeholder="Email Address" id="email">

                            <label for="pw" class="form-label">Password</label>
                            <input type="password" class="form-control col-12 mb-4" placeholder="Password" id="pw">

                            </br>
                            <button type="submit" class="btn btn-warning col-12 mt-2" onclick="alert('Use : SignIn With Google');">SignUp</button>

                            <!--  -->
                            <?php

                            // init configuration
                            $clientID = $_ENV['CLIENT_ID'];
                            $clientSecret = $_ENV['CLIENT_SECRET'];
                            $redirectUri = $_ENV['REDIRECT_URI'];

                            // create Client Request to access Google API
                            $client = new Google_Client();
                            $client->setClientId($clientID);
                            $client->setClientSecret($clientSecret);
                            $client->setRedirectUri($redirectUri);
                            $client->addScope("email");
                            $client->addScope("profile");

                            // authenticate code from Google OAuth Flow
                            if (isset($_GET['code'])) {
                                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                                $client->setAccessToken($token['access_token']);

                                // get profile info
                                $google_oauth = new Google_Service_Oauth2($client);
                                $google_account_info = $google_oauth->userinfo->get();
                                $email =  $google_account_info->email;
                                $name =  $google_account_info->name;

                                // now you can use this profile info to create account in your website and make user logged in.
                            } else {
                                echo "<a href='" . $client->createAuthUrl() . "' class='btn btn-outline-danger col-12 mt-4'><i class='bi bi-google'></i>&nbsp;&nbsp;SignIn With Google</a>";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
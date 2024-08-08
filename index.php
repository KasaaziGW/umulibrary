<?php
session_start();
if (isset($_SESSION['fullname'])) header('location: ./api/index.php');
include('server.php');
require_once 'config.php';

$loginUrl = $client->createAuthUrl();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMU Library System</title>
    <link rel="stylesheet" href="./css/styles.css" type='text/css' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./images/logo.png">
    <script src="./js/custom.js"></script>
</head>

<body>
    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3" id="bgshadow">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <!-- <div class="text-center mb-3">
                                <a href="./index.php">
                                    <img src="./images/logo.png" alt="Lib system logo" width="100">
                                </a>
                            </div> -->
                            <h1 class="fs-6 fw-normal text-center text-black mb-4" style="margin-top: -18px;">
                                For first time users, select the <strong>alternative</strong> login option and sign in with your umu email.
                                After your first login, you can then login with your email and the password you set upon the first time you logged in.
                            </h1>
                            <form action="index.php" method="post">
                                <?php include('errors.php'); ?>
                                <?php include('./api/success.php'); ?>
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <!-- <i class="fa fa-user fa-lg"></i> -->
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Username goes here" value='<?php if (isset($_POST["username"])) {
                                                                                                                                                                echo $_POST["username"];
                                                                                                                                                            } ?>'>
                                            <label for="username" class="form-label">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <!-- <i class="fa fa-lock fa-lg"></i> -->
                                            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password goes here" value='<?php if (isset($_POST["password"])) {
                                                                                                                                                                            echo $_POST["password"];
                                                                                                                                                                        } ?>'>
                                            <label for="password" class="form-label">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-primary btn-lg" type="submit" name="userlogin">Sign In</button>
                                        </div>
                                        <hr data-content="alternatively" class="hr-text">
                                    </div>

                                    <div class="col-12">
                                        <form action="<?= $loginUrl ?>" method="get">
                                            <div class="d-grid my-3">
                                                <button class="btn btn-primary btn-lg" type="submit" name="googlelogin"><a href="<?= $loginUrl ?>" class="link-light link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Google Sign In</a></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>

</body>

</html>
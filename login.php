<?php

ini_set('session.cookie_samesite', "None");

session_start();

if (!isset($_SESSION['username'])) $_SESSION['username'] = "Blank";

if (!isset($_SESSION['auth'])) $_SESSION['auth'] = false;
else if ($_SESSION['auth'] == true) header("Location: ./index.php");

include("./php/include/_connect.php");

if (!isset($_COOKIE['auth'])) setcookie("auth", false, [
  'expires' => time() + 86400,
  'path' => '/',
  'domain' => 'chunguschat.lilithtech.dev',
  'secure' => true,
  'httponly' => true,
  'samesite' => 'None',
]);

else if ($_COOKIE['auth'] == true) header("Location");

if (isset($_GET['username'])) header("Location: ./index.php");

?>

<!DOCTYPE html>
<html>

<head>
  <title>Chunguschat | Login</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/login.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
<script>
        function onSubmit(token) {
        const username = $("#username").val();
        const password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "./php/log_in.php",
            data: $("#login_form").serialize(),
            success: function (data) {
                console.log(data);
                if (data == "true") window.location.href = "../";
            },
            error: function (data) {
                $("#password").val = "";
                Swal.fire({
                    title: "Authentication Request Denied",
                    text: data.responseText,
                    icon: "error",
                    heightAuto: false,
                    color: "white",
                });
            },
        });
      }
  </script>
  <div class="center">
    <h1>Login</h1>
    <form id="login_form" action="/php/log_in.php" method="post">
      <div class="txt_field">
        <input type="text" name="username" id="username" required>
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" id="password" required>
        <span></span>
        <label>Password</label>
      </div>
      <button class="g-recaptcha btn btn-primary" 
        data-sitekey="6Ld-VL4pAAAAAM6ud31pqNjQm_kpykeu6DZ49XTD" 
        data-callback='onSubmit' 
        data-action='submit'>Login!</button>
    </form>
  </div>
  <script src="./js/login.js"></script>
</body>

</html>
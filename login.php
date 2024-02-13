<?php

session_start();

if (!isset($_SESSION['username'])) {
  $_SESSION['username'] = "Blank";
}

if (!isset($_SESSION['auth'])) {
  $_SESSION['auth'] = false;
}

include("./php/include/_connect.php");

if (isset($_GET['username'])) {
  header("Location: ../admin_page_user");
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/login.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>


  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
  <div class="center">
    <h1>Login</h1>
    <form id="login_form" action="./php/log_in.php" method="post">
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
      <input type="submit" value="Login">
    </form>
  </div>
  <script src="./js/login.js"></script>
</body>

</html>
<?php

session_start();

if (!isset($_SESSION['username'])) {
	$_SESSION['username'] = "Blank";
}

if (!isset($_SESSION['auth']))
{
	$_SESSION['auth'] = false;
}

include("./php/include/_connect.php");

if (isset($_GET['username']))
{
    header("Location: ../admin_page_user");
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="center">
    <h1>Login</h1>
    <form action="php/log_in.php" method="post">
      <div class="txt_field">
        <input type="text" name="username" required>
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required>
        <span></span>
        <label>Password</label>
      </div>
      <input type="submit" value="Login">
    </form>
  </div>

</body>

</html>
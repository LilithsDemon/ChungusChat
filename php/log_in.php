<?php

require_once("./include/_bdie.php");

if (isset($_POST['username'], $_POST['password']))
{
    require_once("./include/_connect.php");

    $username = $_POST['username'];
    $user_password = $_POST['password'];

    $username = mysqli_real_escape_string($connect, $username);
    $user_password = mysqli_real_escape_string($connect, $user_password);

	$username = htmlspecialchars($username, ENT_QUOTES);
    $user_password = htmlspecialchars($user_password, ENT_QUOTES);

    $SQL = "SELECT * FROM `Users` WHERE `Username` = ?";

    $stmt = mysqli_prepare($connect, $SQL);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) === 1)
    {
        $USER = mysqli_fetch_assoc($result);

        $hash = $USER['Password'];

        if (password_verify($user_password, $hash))
        {        
            session_start();

            $_SESSION['auth'] = true;  

            $_SESSION['userID'] = $USER['UserID'];
            $_SESSION['username'] = $USER['Username'];
            $_SESSION['user_first_name'] = $USER['FirstName'];
            $_SESSION['user_last_name'] = $USER['LastName'];
            $_SESSION['user_about'] = $USER['About'];

            DieWithStatus("true", 200);
        }
    }
    DieWithStatus("Your username or password is incorrect.", 401);
}

DieWithStatus("You must enter a username and password.", 400);
?>
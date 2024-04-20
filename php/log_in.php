<?php

require_once("./include/_bdie.php");

// This runs after log in, it sets up all the variables that are needed for the user

if (isset($_POST['username'], $_POST['password'])) {
    require_once("./include/_connect.php");
    include("./include/_execute.php");

    $username = $_POST['username'];
    $user_password = $_POST['password'];

    $SQL = "SELECT * FROM `Users` WHERE `Username` = ?";

    $result = executeCommand($SQL, 's', [$username]);

    if (mysqli_num_rows($result) === 1) {
        $USER = mysqli_fetch_assoc($result);

        $hash = $USER['Password'];

        if (password_verify($user_password, $hash)) {
            session_start();

            $_SESSION['auth'] = true;
            $_COOKIE['auth'] = true;

            $_SESSION['userID'] = $USER['UserID'];
            $_SESSION['username'] = $USER['Username'];
            $_SESSION['user_first_name'] = $USER['FirstName'];
            $_SESSION['user_last_name'] = $USER['LastName'];
            $_SESSION['user_about'] = $USER['About'];
            $_SESSION['creator'] = $USER['Creator'];
            $_SESSION['admin'] = $USER['Admin'];
            $_SESSION['maxRooms'] = $USER['MaxRooms'];

            DieWithStatus("true", 200);
        }
    }
    DieWithStatus("Your username or password is incorrect.", 401);
}

DieWithStatus("You must enter a username and password.", 400);

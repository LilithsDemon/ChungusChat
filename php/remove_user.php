<?php
    require_once("./include/_bdie.php");
    require_once('include/_execute.php');
    require_once('include/_connect.php');
    session_start();

    // this variable is sent when opening a profile, finding which profile was opened
    if(!isset($_SESSION['currentProfile'])) DieWithStatus("No User", 401);

    // Check to make sure user exists, stops missuse of the program
    $SQL = "SELECT * FROM `Users` WHERE `UserID` = ?";
    $result = executeCommand($SQL, 's', [$_SESSION['currentProfile']]);
    if(mysqli_num_rows($result) == 0) DieWithStatus("User not found!", 401);
    $DATA = mysqli_fetch_assoc($result);

    // Remove user from the database
    // When removing a user we change the username and the name
    // And set password to a value unatainable by hashing
    // This allows users to still see messages sent by them even though their account is deleted
    // This might be useful to ensure that group messages still make sense
    $SQL = "UPDATE `Users` SET `Username`='No_User', `FirstName`='Removed', `LastName`='User', `Password`='0', `Role`='',`About`='',`ImgSrc`='https://proficon.stablenetwork.uk/api/initials/Removed User.svg',`Admin`=0,`Creator`=0,`MaxRooms`=0 WHERE `UserID` = 6;";
    $result = executeCommand($SQL, 's', [$DATA[`UserID`]]);
    DieWithStatus("User Removed", 200);
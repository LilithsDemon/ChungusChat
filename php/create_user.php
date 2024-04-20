<?php
    require_once("./include/_bdie.php");
    require_once('include/_execute.php');
    require_once('include/_connect.php');
    session_start();

    // Ensures that all data is sent in post - Spread out into multiple if statements as in my opinion it is easier to read
    if(!isset($_POST['username']) || $_POST['username'] == "") DieWithStatus("Username must be entered", 401);
    if(!isset($_POST['password']) || $_POST['password'] == "") DieWithStatus("Password must be entered", 401);
    if(!isset($_POST['first_name']) || $_POST['first_name'] == "" || !isset($_POST['last_name']) || $_POST['last_name'] == "") DieWithStatus("Name must be entered", 401);
    if(!isset($_POST['role'])) DieWithStatus("Role must be entered", 401);
    if(!isset($_POST['admin']) || $_POST['admin'] == "") DieWithStatus("Admin status must be entered", 401);
    if(!isset($_POST['creator']) || $_POST['creator'] == "") DieWithStatus("Creator status must be entered", 401);

    // Checks to see if the username already exists

    $SQL = "SELECT `Username` FROM `Users` WHERE `Username` = ?;";
    $result = executeCommand($SQL, 's', [$_POST['username']]);
    if(mysqli_num_rows($result) > 0) DieWithStatus("Username already exists", 401);

    // Inserts into the database

    $SQL = "INSERT INTO `Users`(`UserID`, `Username`,`FirstName`, `LastName`, `Password`, `Role`, `About`, `ImgSrc`, `Admin`, `Creator`, `MaxRooms`) VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, 10);";
    $result = executeCommand($SQL, 'sssssssss', [$_POST['username'], $_POST['first_name'], $_POST['last_name'], password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['role'], "", "https://proficon.stablenetwork.uk/api/initials/" . $_POST['first_name'] . " " . $_POST['last_name'] . ".svg", $_POST['admin'], $_POST['creator']]);
    DieWithStatus("User created", 200);
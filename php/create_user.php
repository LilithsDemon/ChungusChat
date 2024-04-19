<?php
    require_once("./include/_bdie.php");
    require_once('include/_execute.php');
    require_once('include/_connect.php');
    session_start();

    if(!isset($_POST['username']) || $_POST['username'] == "") DieWithStatus("Username must be entered", 401);
    if(!isset($_POST['password']) || $_POST['password'] == "") DieWithStatus("Password must be entered", 401);
    if(!isset($_POST['first_name']) || $_POST['first_name'] == "" || !isset($_POST['last_name']) || $_POST['last_name'] == "") DieWithStatus("Name must be entered", 401);
    if(!isset($_POST['role'])) DieWithStatus("Role must be entered", 401);
    if(!isset($_POST['admin']) || $_POST['admin'] == "") DieWithStatus("Admin status must be entered", 401);
    if(!isset($_POST['creator']) || $_POST['creator'] == "") DieWithStatus("Creator status must be entered", 401);

    function sanitiseInput($connect, $data)
    {
        $data = mysqli_real_escape_string($connect, $data);
        $data = htmlspecialchars($data, ENT_QUOTES);
        return $data;
    }

    $username = sanitiseInput($connect, $_POST['username']);
    $password = sanitiseInput($connect, $_POST['password']);
    $firstname = sanitiseInput($connect, $_POST['first_name']);
    $lastname = sanitiseInput($connect, $_POST['last_name']);
    $role = sanitiseInput($connect, $_POST['role']);
    $admin = sanitiseInput($connect, $_POST['admin']);
    $creator = sanitiseInput($connect, $_POST['creator']);

    $SQL = "SELECT `Username` FROM `Users` WHERE `Username` = ?;";
    $result = executeCommand($SQL, 's', [$_POST['username']]);
    if(mysqli_num_rows($result) > 0) DieWithStatus("Username already exists", 401);

    $SQL = "INSERT INTO `Users`(`UserID`, `Username`,`FirstName`, `LastName`, `Password`, `Role`, `About`, `ImgSrc`, `Admin`, `Creator`, `MaxRooms`) VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, 10);";
    $result = executeCommand($SQL, 'sssssssss', [$_POST['username'], $_POST['first_name'], $_POST['last_name'], password_hash($_POST['password'], PASSWORD_BCRYPT), $_POST['role'], "", "https://proficon.stablenetwork.uk/api/initials/" . $_POST['first_name'] . " " . $_POST['last_name'] . ".svg", $_POST['admin'], $_POST['creator']]);
    DieWithStatus("User created", 200);
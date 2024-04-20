<?php

require_once("./include/_bdie.php");
require_once('./new_group_users.php');
session_start();

// Checks to make sure the needed data has been sent in POST
// 'Choose User..' is the default value of the dropdown menu

// Anything with DieWithStatus allows the message to be sent to sweetalert so user can see if issues
// Esepically useful if they made an error.

if (!isset($_POST['username']) || $_POST['username'] == "" || $_POST['username'] == 'Choose user..') DieWithStatus("Username must be entered", 401);
if($_POST['username'] == $_SESSION['username']) DieWithStatus("Cannot add yourself to group", 401);

$all_users = $_SESSION['group_users']->GetUsers(); //Gets all users wanting to be made in the group
$username = $_POST['username'];

for($i = 0; $i < sizeof($all_users); $i++)
{
    if($all_users[$i][0] == $username) DieWithStatus("User already added", 401); // Stops users being added multiple times
}

require_once("./include/_connect.php");
require_once("./include/_execute.php");

$SQL = "SELECT * FROM `Users` WHERE `Username` = ?";

$result = executeCommand($SQL, 's', [$username]);

if(mysqli_num_rows($result) === 1)
{
    $_SESSION['group_users']->AddUser($username);
    DieWithStatus("User added", 200); // Success
}
else DieWithStatus("User does not exist", 401);

?>
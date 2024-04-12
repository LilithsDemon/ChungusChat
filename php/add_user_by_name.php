<?php

require_once("./include/_bdie.php");
require_once('./new_group_users.php');
session_start();

if (!isset($_POST['username']) || $_POST['username'] == "" || $_POST['username'] == 'Choose user..') DieWithStatus("Username must be entered", 401);
if($_POST['username'] == $_SESSION['username']) DieWithStatus("Cannot add yourself to group", 401);

$all_users = $_SESSION['group_users']->GetUsers();
$username = $_POST['username'];

for($i = 0; $i < sizeof($all_users); $i++)
{
    if($all_users[$i][0] == $username) DieWithStatus("User already added", 401);
}

require_once("./include/_connect.php");
require_once("./include/_execute.php");

$SQL = "SELECT * FROM `Users` WHERE `Username` = ?";
$username = mysqli_real_escape_string($connect, $username);
$username = htmlspecialchars($username, ENT_QUOTES);

$result = executeCommand($SQL, 's', [$username]);

if(mysqli_num_rows($result) === 1)
{
    $_SESSION['group_users']->AddUser($username);
    DieWithStatus("User added", 200);
}
else DieWithStatus("User does not exist", 401);

?>
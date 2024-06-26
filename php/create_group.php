<?php
    require_once("./include/_bdie.php");
    require_once('include/_execute.php');
    require_once('include/_connect.php');
    require_once("../components/user_block.php");
    include("./new_group_users.php");
    session_start();

    // Makes sure the correct data is sent in post
    if(!isset($_POST['group_name']) || $_POST['group_name'] == "") DieWithStatus("Group name must be entered", 401);
    $group_name = $_POST['group_name'];

    //If they are not the admin they are limited to the amount of groups they can create
    if($_SESSION['admin'] !== 1)
    {
        $SQL = "SELECT COUNT(`RoomID`) AS `COUNT` FROM `ChatRooms` WHERE `CreatedBy` = ?";
        $result = executeCommand($SQL, 'i', [$_SESSION['userID']]);
        $DATA = mysqli_fetch_assoc($result);

        if($DATA['COUNT'] >= $_SESSION['maxRooms']) DieWithStatus("You have reached the maximum amount of groups you can create", 401);
    }

    //To make sure that the group name is unique

    $SQL = "SELECT `RoomName` FROM `ChatRooms` WHERE `RoomName` = ?";
    $result = executeCommand($SQL, 's', [$group_name]);

    if(mysqli_num_rows($result) > 0) DieWithStatus("Group already exists with that name", 401);

    //Inserts the group into the database

    $SQL = "INSERT INTO `ChatRooms`(`RoomID`, `RoomName`, `RoomImg`, `CreatedBy`, `TIMESTAMP`) VALUES (null,?,?,?,null)";
    $result = executeCommand($SQL, 'sss', [$group_name, "https://proficon.stablenetwork.uk/api/initials/" . $group_name . ".svg", $_SESSION['userID']]);

    // Gets the room id of the group that was just created

    $SQL = "SELECT `RoomID` FROM `ChatRooms` WHERE `RoomName` = ?";
    $result = executeCommand($SQL, 's', [$group_name]);
    $DATA = mysqli_fetch_assoc($result);
    $room_id = $DATA['RoomID'];

    // If the user creating the group is not in the group, they are added to the group

    if($_SESSION['group_users']->GetUserByName($_SESSION['username']) == false) $_SESSION['group_users']->AddUser($_SESSION['username']);
    $group_users = $_SESSION['group_users']->GetUsers();

    //Foreach user in the group they get linked to the group so they can access it.

    for($i = 0; $i < sizeof($group_users); $i++)
    {
        $SQL = "SELECT `UserID` FROM `Users` WHERE `Username` = ?";
        $result = executeCommand($SQL, 's', [$group_users[$i][0]]);
        $DATA = mysqli_fetch_assoc($result);
        $user_id = $DATA['UserID'];

        $SQL = "INSERT INTO `UserToRoom`(`LinkID`, `UserID`, `RoomID`) VALUES (null, ?, ?)";
        $result = executeCommand($SQL, 'ss', [$user_id, $room_id]);
    }

    $_SESSION['group_users'] = new GroupUsers();
    DieWithStatus("Group made", 200);
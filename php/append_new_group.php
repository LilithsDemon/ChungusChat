<?php 
    require_once('../components/group_block.php');
    require_once('./include/_connect.php');
    require_once('./include/_execute.php');

    session_start();

    // Checks to make sure all data is sent in post properly
    if(!isset($_POST['Name'])) die("No Data recieved!");

    $SQL = "SELECT * FROM `ChatRooms` WHERE `RoomName` = ?";
    $result = executeCommand($SQL, 's', [$_POST['Name']]);
    $DATA = mysqli_fetch_assoc($result);

    $SQL = "SELECT `LinkID` FROM `UserToRoom` WHERE `RoomID` = ? AND `UserID` = ?";
    $result = executeCommand($SQL, 'ii', [$DATA['RoomID'], $_SESSION['userID']]);
    if(mysqli_num_rows($result) == 0) die("You are not a member of this group!"); // Only appens group if they are in the group

    $group = new ChatBlock($DATA['RoomImg'], $DATA['RoomName'], "No Message yet", $DATA['RoomID']);
    $group->outputBlock(); // Outputs the group block

<?php

require_once('./php/include/_bdie.php');
session_start();

if(isset($_SESSION['userID']) and isset($_SESSION['chat_userID']))
{

    if(!isset($_SESSION['message_count']))
    {
        $_SESSION['message_count'] = 0;
    }

require_once("./php/include/_connect.php");
include('./php/get_pfp.php');

$SQL = "SELECT COUNT(`MessageID`) as 'Count' FROM `Messages` WHERE `LocationID` = ?;";
$stmt = mysqli_prepare($connect, $SQL);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$DATA = mysqli_fetch_assoc($result);

if($DATA['Count'] > $_SESSION['message_count'])
{
    $_SESSION['message_count'] = $DATA['Count'];

    $SQL = "SELECT `Users`.`UserID`, `Users`.`Username`, `Users`.`FirstName`, `Users`.`LastName`, `TIMESTAMP`, `Message` FROM `Messages` LEFT JOIN `Users` ON `Users`.`UserID` = `Messages`.`SenderID` WHERE `LocationID` = ? ORDER BY `TIMESTAMP` DESC;";
    $stmt = mysqli_prepare($connect, $SQL);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $TOAST_DATA = mysqli_fetch_assoc($result);

    ?>
        <div class="toast-header">
            <img  <?php echo 'src="' . getPfpLink($TOAST_DATA['UserID']) . '"' ?> height="25px" width="25px" class="rounded me-2" alt="...">
            <strong class="me-auto"><?php echo $TOAST_DATA['Username'] ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $TOAST_DATA['Message']; ?>
        </div>
    <?php
} else if ($DATA['Count'] < $_SESSION['message_count']) 
{
    $_SESSION['message_count'] == $DATA['Count'];
    DieWithStatus(404, "Message not found");
} else
{
    DieWithStatus(404, "Message not found");
}
}
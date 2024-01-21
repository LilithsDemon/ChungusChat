<?php

session_start();

if(isset($_SESSION['userID']) and isset($_SESSION['chat_userID']))
{

require_once("./php/include/_connect.php");



$SQL = "SELECT `Message`, `TIMESTAMP`, `SenderID` FROM `Messages` WHERE (`SenderID` = ? AND `LocationID` = ?) OR (`SenderID` = ? AND `LocationID` = ?);";

$stmt = mysqli_prepare($connect, $SQL);
mysqli_stmt_bind_param($stmt, "iiii", $_SESSION['userID'], $_SESSION['chat_userID'], $_SESSION['chat_userID'], $_SESSION['userID']);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0)
{
    while($DATA = mysqli_fetch_assoc($result))
    if($DATA['SenderID'] != $_SESSION['userID'])
    {
        echo "<li style='color: pink;'>" . $DATA['Message'] . " - " . $DATA['TIMESTAMP'] . "</li>";
    }
    else
    {
        echo "<li>" . $DATA['Message'] . " - " . $DATA['TIMESTAMP'] . "</li>";
    }
    ?>
</form>
<?php
} else 
{
    echo "There are no messages";
}
}
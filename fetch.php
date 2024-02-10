<?php

session_start();

if(isset($_SESSION['RoomID']))
{

require_once("./php/include/_connect.php");
include('./php/include/_execute.php');

$SQL = "SELECT `Users`.`Username`, `SenderID`, `MessageID`, `Message`, `TIMESTAMP`, `RoomID`, `Seen` FROM `Messages` LEFT JOIN `Users` ON `Users`.`UserID` = `Messages`.`SenderID` WHERE `RoomID` = ? ORDER BY `TIMESTAMP` ASC;";

$result = executeCommand($SQL, 'i', [$_SESSION['RoomID']]);

if (mysqli_num_rows($result) > 0)
{
    while($DATA = mysqli_fetch_assoc($result))
    if($DATA['SenderID'] != $_SESSION['userID'])
    {
        ?>
            <div class="card other mt-4 w-75">
                <div class="card-header">
                    <?php echo $DATA['Username'] . " | " . $DATA['TIMESTAMP'] ?>
                </div>
                <div class="card-body">
                    <?php echo $DATA['Message'] ?>
                </div>
            </div>
        <?php
        if($DATA['Seen'] == 0)
        {
            $SQL = "UPDATE `Messages` SET `Seen` = 1 WHERE `MessageID` = ?;";

            $seen = executeCommand($SQL, 'i', [$DATA['MessageID']]);
        
        }
    }
    else
    {
        ?>
            <div class="card self mt-4 d-flex w-75">
                <div class="card-header">
                    <?php echo $DATA['Username'] . " | " . $DATA['TIMESTAMP'] ?>
                </div>
                <div class="card-body">
                    <?php echo $DATA['Message'] ?>
                </div>
            </div>
        <?php
    }
    ?>
<?php
die();
} else 
{
    echo "There are no messages";
    die();
}
}
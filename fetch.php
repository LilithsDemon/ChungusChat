<?php

session_start();

if(isset($_SESSION['userID']) and isset($_SESSION['chat_userID']))
{

require_once("./php/include/_connect.php");



$SQL = "SELECT `Users`.`Username`, `Message`, `TIMESTAMP`, `SenderID` FROM `Messages` LEFT JOIN `Users` ON `Users`.`UserID` = `Messages`.`SenderID` WHERE (`SenderID` = ? AND `LocationID` = ?) OR (`SenderID` = ? AND `LocationID` = ?) ORDER BY `TIMESTAMP` ASC;";

$stmt = mysqli_prepare($connect, $SQL);
mysqli_stmt_bind_param($stmt, "iiii", $_SESSION['userID'], $_SESSION['chat_userID'], $_SESSION['chat_userID'], $_SESSION['userID']);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

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
} else 
{
    echo "There are no messages";
}
}
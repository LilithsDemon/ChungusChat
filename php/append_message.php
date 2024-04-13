<?php 
    require_once('../components/new_message.php');

    session_start();

    if(!isset($_POST['RoomID']) || !isset($_POST['Message']) || !isset($_POST['SenderID'])) die("No Data recieved!");

    if($_POST['RoomID'] == $_SESSION['RoomID'])
    {
        if($_POST['SenderID'] == $_SESSION['userID'])
        {
            $message = new NewMessage($_POST['Message'], $_POST['SenderID'], $_POST['RoomID']);
            $message->getMessage();
        } else {
            $message = new SelfNewMessage($_POST['Message'], $_POST['SenderID'], $_POST['RoomID']);
            $message->getMessage();
        }
    }
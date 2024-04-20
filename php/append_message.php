<?php 
    require_once('../components/new_message.php'); // This is gives us html for the message

    session_start();

    // Checks to make sure all data is sent in post properly
    if(!isset($_POST['RoomID']) || !isset($_POST['Message']) || !isset($_POST['SenderID'])) die("No Data recieved!");

    // Checks to make sure the room the message has been sent in, is the same group the user is currently in
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
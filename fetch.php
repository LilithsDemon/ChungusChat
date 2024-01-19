<?php

if(!file_exists("data.txt")) die("No messages recieved yet!");

$msgs = file("data.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

//var_dump($msgs);

foreach($msgs as $msg)
{
    echo "<li>" . $msg . "</li>";
}
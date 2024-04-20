<?php

// This function allows for a better way to die in PHP
// This allows us to send a message as to why something did not work
// Can be integrated nicely with sweet alerts so that users can see 
// issues such as they entered the wrong details in login

function DieWithStatus($msg, $http_status = 200) {
    header("HTTP/1.0 $http_status $msg");
    die($msg);
}
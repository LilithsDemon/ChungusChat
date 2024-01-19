<?php
if(!isset($_POST['txtInput'])) die("No message recieved!");

$value = $_POST['txtInput'];

$value = date("H:i:s") . " - " . $value;

file_put_contents("data.txt", $value . PHP_EOL, FILE_APPEND);
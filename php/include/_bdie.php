<?php

function DieWithStatus($msg, $http_status = 200) {
    header("HTTP/1.0 $http_status $msg");
    die($msg);
}
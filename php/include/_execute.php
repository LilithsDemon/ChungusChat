<?php
require_once("./php/include/_connect.php");

function executeCommand($sql, $param_type, $params)
{
    global $connect;
    $stmt = mysqli_prepare($connect, $sql);
    if ($stmt === false) {
        return false;
    }
    if ($params !== null) {
        mysqli_stmt_bind_param($stmt, $param_type, ...$params);
    }
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function executeCommandNoParams($sql)
{
    global $connect;
    $stmt = mysqli_prepare($connect, $sql);
    if ($stmt === false) {
        return false;
    }
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
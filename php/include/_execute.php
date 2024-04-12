<?php

function executeCommand($sql, $param_type, $params)
{
    include("_connect.php");
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
    include("_connect.php");
    $stmt = mysqli_prepare($connect, $sql);
    if ($stmt === false) {
        return false;
    }
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
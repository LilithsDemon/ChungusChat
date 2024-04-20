<?php

// This function allows us to execute a command on the database
// It stops the need to write out the same code multiple times
// It also sanitises input so it does not need to be done in other places of code
function executeCommand($sql, $param_type, $params)
{
    include("_connect.php"); // This allows us to connect to the database

    //Allows any inputs to be sanitised so that there is lower risk of SQL injection or any other type of attack
    for($i = 0; $i < sizeof($params); $i++)
    {
        $params[$i] = mysqli_real_escape_string($connect, $params[$i]);
        $params[$i] = htmlspecialchars($params[$i], ENT_QUOTES);
    }

    $stmt = mysqli_prepare($connect, $sql);
    if ($stmt === false) return false;

    if ($params !== null) mysqli_stmt_bind_param($stmt, $param_type, ...$params);
    else return false; // If there are no parameters code will not be executed properly

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt); // Returns the result of the statement
}

// This is a similar function to the one above but it does not require any parameters
// There will not need to be parameters if the SQL is fixed with no variables
function executeCommandNoParams($sql)
{
    include("_connect.php");
    $stmt = mysqli_prepare($connect, $sql);
    if ($stmt === false) return false;
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
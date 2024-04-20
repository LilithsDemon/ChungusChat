<?php
    include("./new_group_users.php");

    // Just used to ensure the class for making a new group is reset so that it can be reused
    session_start();
    $group_blocks = new NewGroupBlock($_SESSION['group_users']->GetUsers());
    $_SESSION['group_users'] = new GroupUsers();
?>
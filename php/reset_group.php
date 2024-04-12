<?php
    include("./new_group_users.php");
    session_start();
    $group_blocks = new NewGroupBlock($_SESSION['group_users']->GetUsers());
    $_SESSION['group_users'] = new GroupUsers();
?>
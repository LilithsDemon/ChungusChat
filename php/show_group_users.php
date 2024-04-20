<?php
    require_once("../components/user_block.php");
    include("./new_group_users.php");
    session_start();
    // Shows all the users in the group
    $group_blocks = new NewGroupBlock($_SESSION['group_users']->GetUsers());
    $group_blocks->outputBlocks();
?>
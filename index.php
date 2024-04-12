<?php

session_start();

require_once("./php/include/_connect.php");

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "Blank";
}

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
    header("Location: login.php");
}

if ($_SESSION['auth'] == false) {
    header("Location: login.php");
}

require_once('./php/get_pfp.php');
require_once('./php/include/_execute.php');
require_once('./php/new_group_users.php');
require_once('./components/user_block.php');    

$_SESSION['group_users'] = new GroupUsers();

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChungusChat</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/main.css" />
    <script src="https://kit.fontawesome.com/a29f3f1e4b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
    <div class="main-container d-flex">
        <?php
            include('./components/sidebar.php');
        ?>
        <div class="content">
            <?php
                include('./components/extra_nav.php');
            ?>
            <div class="full_page_content d-flex">
                <?php
                    include('./components/chat.php');
                ?>
            </div>
        </div>

        <?php
        include('./components/toast.php');
        ?>

        <?php
            include('./components/profile.php');
            selfProfile();
        ?>
    </div>

    <?php
    include('./components/settings.php');
    include('./components/group_model.php');
    ?>


    <script src="js/swap_panel.js"></script>
    <script src="js/ws_implement.js"></script>
    <script src="js/cloudinary_pfp.js"></script>
    <script src="js/group_creation.js"></script>
</body>

</html>
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

include('./php/get_pfp.php');

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
</head>

<body>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-4 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"> <span class="text-white">ChungusChat</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa fa-stream"></i></button>
            </div>

            <ul class="main_list list-unstyled px-2">
                <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fa fa-comment"></i> Chats</span>
                        <span class="bg-danger rounded-pill text-white py-0 px-2">02</span>
                    </a>
                </li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fa fa-users"></i> Friends</span>
                    </a>
                </li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fa fa-bell"></i> Notifications</span>
                        <span class="bg-danger rounded-pill text-white py-0 px-2">02</span>
                    </a>
                </li>
            </ul>
            <hr class="h-color mx-2">

            <ul class="end_nav list-unstyled flex-column justify-content-end d-flex px-2">
                <li class=""><a id="settings_open" data-bs-toggle="modal" data-bs-target="#settings" href="#settings" class="text-decoration-none px-3 py-2 d-block"><i class="fa fa-bars"></i>
                        Settings</a></li>
                <li class="profile_open"><a data-bs-toggle="offcanvas" href="#offCanvasProfile" role="button" class="text-decoration-none px-3 py-2 d-block"><i class="fa fa-user"></i>
                        Profile</a></li>
            </ul>

        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i style="color: #eee;" class="fa fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#">ChungusChat</a>
                    </div>
                </div>
            </nav>
            <div class="full_page_content d-flex">
                <div class="chat-groups list-group px-2 pt-4 pd-4 d-block d-flex">
                    <?php
                    $SQL = "SELECT * FROM `Users` WHERE`UserID` != ?;";

                    $stmt = mysqli_prepare($connect, $SQL);
                    mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) > 0) {
                        while ($USER = mysqli_fetch_assoc($result)) {

                    ?>
                            <button class="chat-group list-group-item list-group-item-action d-flex" aria-current="true">
                                <div class="d-flex h-100 w-25 justify-content-center align-items-center">
                                    <img class="profile rounded-circle h-100" <?php echo 'src="' . getPfpLink($USER['UserID']) . '"'; ?> alt="Initials Profile Icon" />
                                </div>
                                <div class="w-75 justify-content-center d-flex flex-column">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 username"><?php echo $USER['Username'] ?></h5>
                                        <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">Some placeholder content ...</p>
                                </div>
                            </button>
                    <?
                        }
                    } else {
                        echo "There are no other users";
                    }

                    ?>
                </div>

                <div class="chat flex-column w-100 h-100 px-3 d-flex">
                    <div class="profile_top d-flex flex-row">
                        <span class="small_to_chat"> <i class="chat_back_button fa-solid fa-left-long"> </i></span>
                        <img id="profile_chat_img" src="https://proficon.stablenetwork.uk/api/initials/un.svg" class="h-100 rounded-circle" alt="User's profile image">
                        <h2 id="chat_username"> Profile Username</h2>
                    </div>
                    <div class="messages">
                        <ul id="chatMessages">
                            <?php
                            if (!isset($_SESSION['chat_userID'])) {
                            ?>
                                <p>No chat open</p>
                            <?php
                            } else {
                            ?>
                                <li>loading ... </li>

                            <?php
                            }
                            ?>

                        </ul>
                    </div>
                    <form id="formSendMsg">
                        <input type="text" name="txtInput" placeholder="Enter your message..."></input>
                        <button type="submit">Send!</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast" id="toast" role="alert" aria-live="assertive" aria-atomic="true">

            </div>
        </div>

        <div class="offcanvas offcanvas-end text-bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offCanvasProfile" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <div class="profile_info_top d-flex flex-column align-items-center justify-content-center">
                    <?php

                    ?>
                    <img <? echo 'src="' . 'https://proficon.stablenetwork.uk/api/initials/' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '.svg' . '"' ?> class="self_profile_img rounded-circle" height="100px" width="100px">
                    <h4 class="pt-2">
                        <?php echo $_SESSION['username'] ?>
                    </h4>
                </div>
                <div class="about_section pt-2 d-flex flex-column">
                    <h4 class="profile_section_title">About</h4>
                    <p>
                        <?php echo $_SESSION['user_about'] ?>
                    </p>
                </div>
                <div class="website_section pt-2 d-flex flex-column">
                    <h4 class="profile_section_title">Website</h4>
                    <a href="#">
                        <p>https://chungus.lilithtech.dev</p>
                    </a>
                </div>
                <div class="social_section pt-2 d-flex flex-column">
                    <h4 class="profile_section_title">Social Media Accounts</h4>
                    <button id="pfp_upload_widget" class="cloudinary-button">Upload files</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="settings" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
            </div>
        </div>
    </div>


    <script src="js/swap_panel.js"></script>
    <script src="js/cloudinary_pfp.js"></script>
</body>

</html>
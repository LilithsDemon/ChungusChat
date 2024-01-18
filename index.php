<?php

session_start();

$_SESSION['username'] = "Susername";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChungusChat</title>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/main.css" />
    <script src="https://kit.fontawesome.com/a29f3f1e4b.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-4 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"> <span class="text-white">ChungusChat</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                        class="fa fa-stream"></i></button>
            </div>

            <ul class="main_list list-unstyled px-2">
                <li class="active"><a href="#"
                        class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
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
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa fa-bars"></i>
                        Settings</a></li>
                <li class="profile_open"><a data-bs-toggle="offcanvas" href="#offCanvasProfile" role="button"
                        class="text-decoration-none px-3 py-2 d-block"><i class="fa fa-user"></i>
                        Profile</a></li>
            </ul>

        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i style="color: #eee;"
                                class="fa fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#">ChungusChat</a>
                    </div>
                </div>
            </nav>
            <div class="full_page_content d-flex">
                <div class="chat-groups list-group px-2 pt-4 pd-4 d-block d-flex">
                    <a href="#" class="chat-group list-group-item list-group-item-action active d-flex" aria-current="true">
                        <div class="d-flex w-25 justify-content-between">
                            <img class="profile" src="https://proficon.stablenetwork.uk/api/initials/lt.svg"
                                alt="Initials Profile Icon" />
                        </div>
                        <div class="w-75 justify-content-center d-flex flex-column">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Username</h5>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">Some placeholder content ...</p>
                        </div>
                    </a>
                    <a href="#" class="chat-group list-group-item list-group-item-action d-flex" aria-current="true">
                        <div class="d-flex w-25 justify-content-between">
                            <img class="profile" src="https://proficon.stablenetwork.uk/api/initials/pt.svg"
                                alt="Initials Profile Icon" />
                        </div>
                        <div class="w-75 justify-content-center d-flex flex-column">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Username</h5>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">Some placeholder content ...</p>
                        </div>
                    </a>
                    <a href="#" class="chat-group list-group-item list-group-item-action d-flex" aria-current="true">
                        <div class="d-flex w-25 justify-content-between">
                            <img class="profile" src="https://proficon.stablenetwork.uk/api/initials/jk.svg"
                                alt="Initials Profile Icon" />
                        </div>
                        <div class="w-75 justify-content-center d-flex flex-column">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Username</h5>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">Some placeholder content ...</p>
                        </div>
                    </a>
                    <a href="#" class="chat-group list-group-item list-group-item-action d-flex" aria-current="true">
                        <div class="d-flex w-25 justify-content-between">
                            <img class="profile" src="https://proficon.stablenetwork.uk/api/initials/jc.svg"
                                alt="Initials Profile Icon" />
                        </div>
                        <div class="w-75 justify-content-center d-flex flex-column">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Username</h5>
                                <small>3 days ago</small>
                            </div>
                            <p class="mb-1">Some placeholder content ...</p>
                        </div>
                    </a>
                </div>

                <div class="chat flex-column px-3 pt-4">
                    <div class="profile_top d-flex flex-row">
                        <span class="small_to_chat"> <i class="chat_back_button fa-solid fa-left-long"> </i></span>
                        <h2> Profile Username</h2>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://i.pinimg.com/originals/c1/8c/44/c18c4491703eeb32fce74753e622b055.jpg"
                                    class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://wallpapers.com/images/hd/hd-black-cat-rqpue91wz43epj50.jpg"
                                    class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://preview.redd.it/black-cat-1920x1080-wallpaper-v0-wskok3z7gr7a1.jpg?auto=webp&s=6291251672cb058df76699e1ef5c6ca930d16656"
                                    class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-end text-bg-dark" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
            id="offCanvasProfile" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                Profile
            </div>
        </div>
    </div>

    <script src="js/swap_panel.js"></script>
</body>

</html>
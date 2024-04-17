<div class="sidebar" id="side_nav">
    <div class="header-box px-4 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4"> <span style="color: var(--bs-body-color);">ChungusChat</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0"><i class="fa fa-stream"></i></button>
    </div>

    <ul class="main_list list-unstyled px-2">
        <li class="active"><a href="#" class="chat-button text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa fa-comment"></i> Chats</span>
                <span class="bg-danger rounded-pill text-white py-0 px-2">02</span>
            </a>
        </li>
        <li class=""><a href="#" class="collegue-button text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                <span><i class="fa fa-users"></i> Colleagues</span>
            </a>
        </li>
    </ul>
    <hr class="h-color mx-4">

    <ul class="end_nav list-unstyled flex-column justify-content-end d-flex px-2">
        <li class=""><a id="settings_open" data-bs-toggle="modal" data-bs-target="#settings" href="#settings"
                class="text-decoration-none px-3 py-2 d-block"><i class="fa fa-bars"></i>
                Settings</a></li>
                <?php
                    $user = $_SESSION['username'];
                ?>
        <li class="profile_open"><a data-bs-toggle="offcanvas" href="#offCanvasProfile" onclick="SetProfile(<?php echo ("'" . $user . "'") ?>) " role="button"
                class="text-decoration-none px-3 py-2 d-block"><i class="fa fa-user"></i>
                Profile</a></li>
        <li class=""><a href="../php/logout.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</a></li>
    </ul>

</div>
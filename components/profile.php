<?php

function selfProfile()
{
    ?>
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offCanvasProfile" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Profile</h5>
            <button type="button" class="btn-close btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div class="profile_info_top d-flex flex-column align-items-center justify-content-center">
                <?php

                ?>
                <img <? echo 'src="' . getPfpLink($_SESSION['userID']) . '"' ?> class="self_profile_img rounded-circle" height="100px" width="100px">
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
                <button id="pfp_upload_widget" class="cloudinary-button">Change Profile Image</button>
            </div>
        </div>
    </div>
    <?php
}
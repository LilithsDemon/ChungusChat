<?php
require_once ("../php/include/_connect.php");
require_once ("../php/include/_execute.php");
session_start();

if(!isset($_POST['Username'])) die("No User");

$SQL = "SELECT * FROM `Users` WHERE `Username` = ?";
$result = executeCommand($SQL, 's', [$_POST['Username']]);
if(mysqli_num_rows($result) == 0) die("User not found!");
$DATA = mysqli_fetch_assoc($result);

$_SESSION['currentProfile'] = $DATA['UserID'];

?>
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Profile</h5>
    <button type="button" class="btn-close btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body d-flex flex-column">
    <div class="profile_info_top d-flex flex-column align-items-center justify-content-center">
        <?php

        ?>
        <img <? echo 'src="' . $DATA['ImgSrc'] . '"' ?> class="self_profile_img rounded-circle" height="100px" width="100px">
        <h4 class="pt-2">
            <?php echo '@' . $DATA['Username'] ?>
        </h4>
        <h3 class="pt-2">
            <?php echo $DATA['FirstName'] . " " . $DATA['LastName'] ?>
        </h3>
    </div>
    <div class="role_secrion pt-2 d-flex flex-column">
        <h4 class="profile_section_title">Role</h4>
        <p>
            <?php echo $DATA['Role'] ?>
        </p>
    </div>
    <div class="about_section pt-2 d-flex flex-column">
        <h4 class="profile_section_title">About</h4>
        <p>
            <?php echo $DATA['About'] ?>
        </p>
    </div>
    <div class="social_section pt-4 d-flex gap-4 flex-column">
    <?php
    if($DATA['UserID'] == $_SESSION['userID'])
    {
        ?>
        <button id="pfp_upload_widget" class="btn btn-primary">Change Profile Image</button>
        <button id="" class="btn btn-primary">Change your About section</button>
        <?php
    }else
    {
        if($_SESSION['admin'] == 1)
        {
            ?>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove_user_model">Delete User</button>
            <?php
        }
    }
    ?>
    </div>
</div>
<?php

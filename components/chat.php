<div class="chat-groups overflow-auto list-group px-2 pt-4 pd-4 d-block d-flex">
    <div class="groups overflow-auto d-flex flex-column">
        <?php
        require_once("./components/group_block.php");
        $SQL = "SELECT `RoomName`, `ChatRooms`.`RoomID`, `RoomImg` FROM `ChatRooms` LEFT JOIN `UserToRoom` ON `UserToRoom`.`RoomID` = `ChatRooms`.`RoomID` WHERE `UserToRoom`.`UserID` = ?;";

        $result = executeCommand($SQL, 'i', [$_SESSION['userID']]);

        if (mysqli_num_rows($result) > 0) {
            require_once("./php/last_message.php");
            while ($DATA = mysqli_fetch_assoc($result)) {
                $group_block = new ChatBlock($DATA['RoomImg'], $DATA['RoomName'], getChatMessage($DATA['RoomID']), $DATA['RoomID']);
                $group_block->outputBlock();
            }
        } else {
            echo "There are no other users";
        }
        ?>
    </div>
    <?php if($_SESSION['creator'] == 1 || $_SESSION['admin'] == 1) { ?>
    <div class="new_group d-flex justify-content-center align-items-center">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#groupModel">New Group</button>
    </div>
    <?php }
    else
    {
        echo "<p style='text-align: center;'>If you think you should be able to create groups: talk to an admin</p>";
    } ?>
</div>

<div class="collegues overflow-auto list-group px-2 pt-4 pd-4 d-flex d-none">
    <div class="groups overflow-auto d-flex flex-column">
        <?php
        require_once("./components/user_block.php");
        $SQL = "SELECT * FROM `Users` WHERE `UserID` != ?;";

        $result = executeCommand($SQL, 'i', [$_SESSION['userID']]);

        if (mysqli_num_rows($result) > 0) {
            require_once("./php/last_message.php");
            while ($DATA = mysqli_fetch_assoc($result)) {
                $group_block = new ChatBlock($DATA['RoomImg'], $DATA['RoomName'], getChatMessage($DATA['RoomID']), $DATA['RoomID']);
                $group_block->outputBlock();
            }
        } else {
            echo "There are no other users";
        }
        ?>
    </div>
    <?php if($_SESSION['creator'] == 1 || $_SESSION['admin'] == 1) { ?>
    <div class="new_group d-flex justify-content-center align-items-center">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#groupModel">New Group</button>
    </div>
    <?php }
    else
    {
        echo "<p style='text-align: center;'>If you think you should be able to create users: talk to an admin</p>";
    } ?>
</div>

<div class="chat flex-column w-100 h-100 px-3 d-flex">
    <div class="profile_top d-flex flex-row">
        <span class="small_to_chat"> <i class="chat_back_button fa-solid fa-left-long"> </i></span>
        <img id="profile_chat_img" src="https://proficon.stablenetwork.uk/api/initials/un.svg"
            class="h-100 rounded-circle" alt="User's profile image">
        <h2 id="chat_username"> Chat name</h2>
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
    <form class="d-flex align-items-center justify-content-center w-100" id="formSendMsg">
        <textarea class="p-2 h-100 mt-4" type="text" name="txtInput" placeholder="Enter your message..."></textarea>
        <button class="p-2 h-100 mt-4" type="submit">Send!</button>
    </form>

</div>
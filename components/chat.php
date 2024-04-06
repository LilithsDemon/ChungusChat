<div class="chat-groups list-group px-2 pt-4 pd-4 d-block d-flex">
    <div class="groups d-flex flex-column">
        <?php
        require_once("./components/group_block.php");
        $SQL = "SELECT `RoomName`, `ChatRooms`.`RoomID`, `RoomImg` FROM `ChatRooms` LEFT JOIN `UserToRoom` ON `UserToRoom`.`RoomID` = `ChatRooms`.`RoomID` WHERE `UserToRoom`.`UserID` = ?;";

        $result = executeCommand($SQL, 'i', [$_SESSION['userID']]);

        if (mysqli_num_rows($result) > 0) {
            require_once("./php/last_message.php");
            while ($DATA = mysqli_fetch_assoc($result)) {
                $group_block = new ChatBlock($DATA['RoomImg'], $DATA['RoomName'], getChatMessage($DATA['RoomID']), "2 days ago", $DATA['RoomID']);
                $group_block->outputBlock();
            }
        } else {
            echo "There are no other users";
        }
        ?>
    </div>
    <div class="new_group d-flex">
        <button type="button" class="btn btn-success">New Group</button>
    </div>
</div>

<div class="chat flex-column w-100 h-100 px-3 d-flex">
    <div class="profile_top d-flex flex-row">
        <span class="small_to_chat"> <i class="chat_back_button fa-solid fa-left-long"> </i></span>
        <img id="profile_chat_img" src="https://proficon.stablenetwork.uk/api/initials/un.svg"
            class="h-100 rounded-circle" alt="User's profile image">
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
    <form class="d-flex align-items-center justify-content-center w-100" id="formSendMsg">
        <textarea class="p-2 h-100 mt-4" type="text" name="txtInput" placeholder="Enter your message..."></textarea>
        <button class="p-2 h-100 mt-4" type="submit">Send!</button>
    </form>

</div>
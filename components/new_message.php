<?php

require_once ("../php/include/_connect.php");
require_once ("../php/include/_execute.php");

class NewMessage
{
    protected $message;
    protected $sender;
    protected $sender_name;
    protected $room;
    public function __construct($message, $sender, $room)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->room = $room;
        $SQL = "SELECT `Username` FROM `Users` WHERE `UserID` = ?";
        $result = executeCommand($SQL, 'i', [$this->sender]);
        $DATA = mysqli_fetch_assoc($result);
        $this->sender_name = $DATA['Username'];
    }

    protected function getPfPLink($userID)
    {
        $SQL = "SELECT `ImgSrc` FROM `Users` WHERE `UserID` = ?;";
        $result = executeCommand($SQL, 'i', [$userID]);
        $DATA = mysqli_fetch_assoc($result);
        return $DATA['ImgSrc'];
    }

    public function getMessage()
    {
        ?>
        <div class="card self mt-4 d-flex w-75">
            <div class="card-header d-flex p-2 gap-2 align-items-center flex-row">
                <?php
                $img = $this->getPfpLink($this->sender);
                ?>
                <a data-bs-toggle="offcanvas" href="#offCanvasProfile" onclick="SetProfile(<?php echo ("'" . $this->sender . "'") ?>)">
                <img class="profile rounded-circle" style="height: 32px;" src="<?php echo $img ?>">
                <?php echo $this->sender_name . "</a> | " . date("Y-m-d h:i:s") ?>
            </div>
            <div class="card-body">
                <?php echo $this->message ?>
            </div>
        </div>
        <?php
    }
}

class SelfNewMessage extends NewMessage
{
    protected $message;
    protected $sender;
    protected $sender_name;
    protected $room;
    public function __construct($message, $sender, $room)
    {
        parent::__construct($message, $sender, $room);
    }

    public function getMessage()
    {
        ?>
        <div class="card other mt-4 w-75">
            <div class="card-header d-flex p-2 gap-2 align-items-center flex-row">
                <?php
                $img = $this->getPfpLink($this->sender);
                ?>
                <a data-bs-toggle="offcanvas" href="#offCanvasProfile" onclick="SetProfile(<?php echo ("'" . $this->sender . "'") ?>)">
                <img class="profile rounded-circle" style="height: 32px;" src="<?php echo $img ?>">
                <?php echo $this->sender . "</a> | " . date("Y-m-d h:i:s") ?>
            </div>
            <div class="card-body">
                <?php echo $this->message ?>
            </div>
        </div>
        <?php
    }
}
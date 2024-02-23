<?php

require_once("./php/include/_connect.php");
require_once("./php/include/_execute.php");

class Message {
    
        protected $message;
        protected $time;

        protected $sender;

        public function getMessage() {
            ?>
                <div class="card self mt-4 d-flex w-75">
                    <div class="card-header">
                        <?php echo $this->sender . " | " . $this->time ?>
                    </div>
                    <div class="card-body">
                        <?php echo $this->message ?>
                    </div>
                </div>
            <?php
        }
    
        public function __construct($message, $time, $sender) {
            $this->message = $message;
            $this->time = $time;
            $this->sender = $sender;
        }
}

class SelfMessage extends Message {

    private $seen;
    private $messageID;
    public function __construct($message, $time, $sender, $seen, $messageID) {
        parent::__construct($message, $time, $sender);
        $this->seen = $seen;
        $this->messageID = $messageID;
    }

    public function getMessage() {
        ?>
            <div class="card other mt-4 w-75">
                <div class="card-header">
                    <?php echo $this->sender . " | " . $this->time ?>
                </div>
                <div class="card-body">
                    <?php echo $this->message ?>
                </div>
            </div>
        <?php
        if($this->seen == 0)
        {
            $SQL = "UPDATE `Messages` SET `Seen` = 1 WHERE `MessageID` = ?;";

            $seen = executeCommand($SQL, 'i', [$this->messageID]);
        
        }
    }
}


class NewMessage {
    protected $message;
    protected $sender;
    protected $sender_name;
    protected $room;
    public function __construct($message, $sender, $room) {
        $this->message = $message;
        $this->sender = $sender;
        $this->room = $room;
        $SQL = "INSERT INTO `Messages`(`MessageID`, `Message`, `TIMESTAMP`, `SenderID`, `RoomID`, `Seen`) VALUES (null,?,null,?,?',null)";
        $result = executeCommand($SQL, 'sii', [$this->message, $this->sender, $this->room]);
        $SQL = "SELECT `Username` FROM `Users` WHERE `UserID` = ?";
        $result = executeCommand($SQL, 'i', [$this->sender]);
        $DATA = mysqli_fetch_assoc($result);
        $this->sender_name = $DATA['Username'];
    }

    public function getMessage() {
        ?>
            <div class="card self mt-4 d-flex w-75">
                <div class="card-header">
                    <?php echo $this->sender_name . " | " . date("Y-m-d h:i:s") ?>
                </div>
                <div class="card-body">
                    <?php echo $this->message ?>
                </div>
            </div>
        <?php
    }
}

class SelfNewMessage extends NewMessage {
    protected $message;
    protected $sender;
    protected $sender_name;
    protected $room;
    public function __construct($message, $sender, $room) {
        parent::__construct($message, $sender, $room);
    }

    public function getMessage() {
        ?>
            <div class="card other mt-4 w-75">
                <div class="card-header">
                    <?php echo $this->sender_name . " | " . date("Y-m-d h:i:s") ?>
                </div>
                <div class="card-body">
                    <?php echo $this->message ?>
                </div>
            </div>
        <?php
    }
}
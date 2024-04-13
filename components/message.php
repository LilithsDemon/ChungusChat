<?php

require_once ("./php/include/_connect.php");
require_once ("./php/include/_execute.php");
require_once ("./php/get_pfp.php");

class Message
{

    protected $message;
    protected $time;

    protected $sender;

    public function getMessage()
    {
        ?>
        <div class="card self mt-4 d-flex w-75">
            <div class="card-header d-flex p-2 gap-2 align-items-center flex-row">
                <?php
                $img = getPfpLinkByName($this->sender);
                ?>
                <img class="profile rounded-circle" style="height: 32px;" src="<?php echo $img ?>">
                <?php echo $this->sender . " | " . $this->time ?>
            </div>
            <div class="card-body">
                <?php echo $this->message ?>
            </div>
        </div>
        <?php
    }

    public function __construct($message, $time, $sender)
    {
        $this->message = $message;
        $this->time = $time;
        $this->sender = $sender;
    }
}

class SelfMessage extends Message
{

    private $seen;
    private $messageID;
    public function __construct($message, $time, $sender, $seen, $messageID)
    {
        parent::__construct($message, $time, $sender);
        $this->seen = $seen;
        $this->messageID = $messageID;
    }

    public function getMessage()
    {
        ?>
        <div class="card other mt-4 w-75">
            <div class="card-header d-flex p-2 gap-2 align-items-center flex-row">
                <?php
                $img = getPfpLinkByName($this->sender);
                ?>
                <img class="profile rounded-circle" style="height: 32px;" src="<?php echo $img ?>">
                <?php echo $this->sender . " | " . $this->time ?>
            </div>
            <div class="card-body">
                <?php echo $this->message ?>
            </div>
        </div>
        <?php
    }
}
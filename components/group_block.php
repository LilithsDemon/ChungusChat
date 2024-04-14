<?php

class Block{
    protected $img;
    protected $title;

    public function __construct($img, $title) {
        $this->img = $img;
        $this->title = $title;
    }
}

class ChatBlock extends Block
{
    private $roomID;
    private $last_message;

    public function outputBlock()
    {
        ?>
            <form method="post" action="./php/open_chat" class="chat-group list-group-item list-group-item-action d-flex" aria-current="true">
                <input type="hidden" name="roomID" value="<?php echo $this->roomID ?>">
                <div class="d-flex w-25 justify-content-center align-items-center">
                    <img class="profile rounded-circle h-100" <?php echo 'src="' . $this->img . '"'; ?> alt="Initials Profile Icon" />
                </div>
                <div class="w-75 justify-content-center d-flex flex-column">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 username"><?php echo $this->title ?></h5>
                    </div>
                    <p class="mb-1 text-truncate" id="<?php echo $this->roomID ?>"><?php echo $this->last_message ?></p>
                </div>
            </form>
        <?php
    }

    public function __construct($img, $title, $last_message, $roomID) {
        parent::__construct($img, $title);
        $this->last_message = $last_message; 
        $this->roomID = $roomID;
    }
}

class UserBlock extends Block
{
    private $last_message;
    private $time;

    public function outputBlock()
    {
        ?>
            <button class="chat-group list-group-item list-group-item-action d-flex" aria-current="true">
                <div class="d-flex h-100 w-25 justify-content-center align-items-center">
                    <img class="profile rounded-circle h-100" <?php echo 'src="' . $this->img . '"'; ?> alt="Initials Profile Icon" />
                </div>
                <div class="w-75 justify-content-center d-flex flex-column">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 username"><?php echo $this->title ?></h5>
                        <small><?php echo $this->time ?></small>
                    </div>
                    <p class="mb-1 text-truncate"><?php echo $this->last_message ?></p>
                </div>
            </button>
        <?php
    }

    public function __construct($img, $title, $last_message, $time) {
        parent::__construct($img, $title);
        $this->last_message = $last_message; 
        $this->time = $time;
    }
}
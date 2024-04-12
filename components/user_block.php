<?php
class GroupBlock{
    public function __construct($user) {
        $this->user = $user;
    }
}

class NewGroupBlock
{
    protected $users;
    public function outputBlocks()
    {
        if(sizeof($this->users) > 0)
        {
            for($i = 0; $i < sizeof($this->users); $i++)
            {
            ?>
                <form class="chat-group list-group-item list-group-item-action d-flex" aria-current="true">
                    <div class="d-flex w-25 justify-content-center align-items-center">
                        <img class="profile rounded-circle h-100" <?php echo 'src="' . $this->users[$i][1] . '"'; ?> alt="Initials Profile Icon" />
                    </div>
                    <div class="w-75 justify-content-center d-flex flex-column">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 name"><?php echo $this->users[$i][2] ?></h5>
                            <small><?php echo $this->users[$i][0] ?></small>
                        </div>
                    </div>
                </form>
            <?php
            }
        }
        else
        {
            ?>
                <h5 class="group_no_users_text">No users currently added</h5>
            <?php
        }
    }


    public function __construct($users) {
        $this->users = $users;
    }
}
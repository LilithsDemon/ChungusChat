<?php

require_once('include/_execute.php');
require_once('include/_connect.php');
class GroupUsers
{
    protected $users;
    protected $users_img;
    protected $users_name;

    function AddUser($username)
    {
        array_push($this->users, $username);
        $SQL = "SELECT `ImgSrc`, `FirstName`, `LastName` FROM `Users` WHERE `Username` = ?";
        $result = executeCommand($SQL, 's', [$username]);
        $DATA = mysqli_fetch_assoc($result);
        array_push($this->users_img, $DATA['ImgSrc']);
        $name = $DATA['FirstName'] . " " . $DATA['LastName'];
        
        array_push($this->users_name, $name);
    }

    function GetUserByVal($user)
    {
        if($user < sizeof($this->users))
        {
            return null;
        }
        return [$this->users[$user] , $this->users_img[$user], $this->users_name[$user]];
    }

    function GetUserByName($username)
    {
        $index = array_search($username, $this->users);
        if($index === false)
        {
            return false;
        }
        return [$this->users[$index] , $this->users_img[$index], $this->users_name[$index]];
    }

    function GetUsers(){
        $users = [];
        for($i = 0; $i < sizeof($this->users); $i++)
        {
            array_push($users, array($this->users[$i], $this->users_img[$i], $this->users_name[$i]));
        }
        return($users);
    }

    function GetNumOfUsers()
    {
        return sizeof($this->users);
    }

    public function __construct()
    {
        $this->users=[];
        $this->users_img=[];
        $this->users_name=[];
    }
}

?>
<?php

//ChatUser.php

class ChatUser
{
	private $UserID;
	private $Username;
	private $FirstName;
	private $LastName;
	private $About;
	private $ImgSrc;

	private $rooms = array();
	public $connect;

	public function __construct($UserID)
	{
		$this->UserID = $UserID;

		require_once('./php/include/_connect.php');
        require_once('./php/include/_execute.php');

		$this->connect = $connect;

		$this->update_data();
	}

	function update_data()
	{
		$SQL = "SELECT `RoomID` FROM `UserToRoom` WHERE `UserID` = ?";
        $result = executeCommand($SQL, 'i', [$this->UserID]);
		while($DATA = mysqli_fetch_assoc($result)) $this->rooms.array_push($DATA['RoomID']);

		$SQL = "SELECT `Username`, `FirstName`, `LastName`, `About`, `ImgSrc` FROM `Users` WHERE `UserID` = ?";
		$result = executeCommand($SQL, 'i', [$this->UserID]);
		$DATA = mysqli_fetch_assoc($result);
		$this->Username = $DATA['Username'];
		$this->FirstName = $DATA['FirstName'];
		$this->LastName = $DATA['LastName'];
		$this->About = $DATA['About'];
		$this->ImgSrc = $DATA['ImgSrc'];
	}
}



?>
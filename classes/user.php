<?php

// This is a class used by the server to generate clients

// The user class is used to store information about a user, such as their rooms and friends by getting data from the database

class ChatUser
{
	private $UserID;
	private $Username;
	private $FirstName;
	private $LastName;
	private $About;
	private $ImgSrc;

	private $Rooms = array();

	private $Friends = array();

	public function __construct($UserID)
	{
		$this->UserID = $UserID;

        require_once('../php/include/_execute.php');

		$this->updateData();
	}

	public function updateData()
	{
		$SQL = "SELECT `RoomID` FROM `UserToRoom` WHERE `UserID` = ?";
        $result = executeCommand($SQL, 'i', [$this->UserID]);
		while($DATA = mysqli_fetch_assoc($result)) $this->Rooms.array_push($DATA['RoomID']);

		$SQL = "SELECT `Username`, `FirstName`, `LastName`, `About`, `ImgSrc` FROM `Users` WHERE `UserID` = ?";
		$result = executeCommand($SQL, 'i', [$this->UserID]);
		$DATA = mysqli_fetch_assoc($result);
		$this->Username = $DATA['Username'];
		$this->FirstName = $DATA['FirstName'];
		$this->LastName = $DATA['LastName'];
		$this->About = $DATA['About'];
		$this->ImgSrc = $DATA['ImgSrc'];
	}

	public function getRooms()
	{
		return $this->Rooms;
	}

	public function getFriends()
	{
		return $this->Friends;
	}

	public function getUserID()
	{
		return $this->UserID;
	}
}
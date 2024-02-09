<?php

//ChatUser.php

class ChatUser
{
	private $user_id;
	private $user_name;
	private $user_email;
	private $user_password;
	private $user_profile;
	private $user_status;
	private $user_created_on;
	private $user_verification_code;
	private $user_login_status;
	public $connect;

	public function __construct()
	{
		require_once('Database_connection.php');

		$database_object = new Database_connection;

		$this->connect = $database_object->connect();
	}

	function setUserId($user_id)
	{
		$this->user_id = $user_id;
	}

	function getUserId()
	{
		return $this->user_id;
	}

	function setUserName($user_name)
	{
		$this->user_name = $user_name;
	}

	function getUserName()
	{
		return $this->user_name;
	}

	function setUserEmail($user_email)
	{
		$this->user_email = $user_email;
	}

	function getUserEmail()
	{
		return $this->user_email;
	}

	function setUserPassword($user_password)
	{
		$this->user_password = $user_password;
	}

	function getUserPassword()
	{
		return $this->user_password;
	}

	function setUserProfile($user_profile)
	{
		$this->user_profile = $user_profile;
	}

	function getUserProfile()
	{
		return $this->user_profile;
	}

	function setUserStatus($user_status)
	{
		$this->user_status = $user_status;
	}

	function getUserStatus()
	{
		return $this->user_status;
	}

	function setUserCreatedOn($user_created_on)
	{
		$this->user_created_on = $user_created_on;
	}

	function getUserCreatedOn()
	{
		return $this->user_created_on;
	}

	function setUserVerificationCode($user_verification_code)
	{
		$this->user_verification_code = $user_verification_code;
	}

	function getUserVerificationCode()
	{
		return $this->user_verification_code;
	}

	function setUserLoginStatus($user_login_status)
	{
		$this->user_login_status = $user_login_status;
	}

	function getUserLoginStatus()
	{
		return $this->user_login_status;
	}

	function make_avatar($character)
	{
	    $path = "images/". time() . ".png";
		$image = imagecreate(200, 200);
		$red = rand(0, 255);
		$green = rand(0, 255);
		$blue = rand(0, 255);
	    imagecolorallocate($image, $red, $green, $blue);  
	    $textcolor = imagecolorallocate($image, 255,255,255);

	    $font = dirname(__FILE__) . '/font/arial.ttf';

	    imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
	    imagepng($image, $path);
	    imagedestroy($image);
	    return $path;
	}

	function get_user_data_by_email()
	{

		$query = "SELECT * FROM `chat_user_table` WHERE `user_email` = ?";

        $stmt = mysqli_prepare($this->connect, $query);
        mysqli_stmt_bind_param($stmt, "s", $this->user_email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $user_data = mysqli_fetch_assoc($result);
		return $user_data;
	}

	function save_data()
	{
		$query = "INSERT INTO `chat_user_table` (`user_name`, `user_email`, `user_password`, `user_profile`, `user_status`, `user_created_on`, `user_verification_code`) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($this->connect, $query);
        mysqli_stmt_bind_param($stmt, "sssssss",  $this->user_name, $this->user_email, $this->user_password, $this->user_profile, $this->user_status, $this->user_created_on, $this->user_verification_code);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function is_valid_email_verification_code()
	{
		$query = "SELECT * FROM `chat_user_table` WHERE `user_verification_code` = ?";

        $stmt = mysqli_prepare($this->connect, $query);
        mysqli_stmt_bind_param($stmt, "s", $this->user_verification_code);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

		if(mysqli_num_rows($result) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function enable_user_account()
	{
		$query = "UPDATE `chat_user_table` SET `user_status` = ? WHERE `user_verification_code` = ?";

        $stmt = mysqli_prepare($this->connect, $query);
        mysqli_stmt_bind_param($stmt, "ss", $this->user_status, $this->user_verification_code);

		if(mysqli_stmt_execute($stmt))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function update_user_login_data()
	{
		$query = "UPDATE `chat_user_table` SET `user_login_status` = ? WHERE user_id = ?";

        $stmt = mysqli_prepare($this->connect, $query);
        mysqli_stmt_bind_param($stmt, "ss", $this->user_login_status, $this->user_id);

		if(mysqli_stmt_execute($stmt))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function get_user_data_by_id()
	{
		$query = "SELECT * FROM chat_user_table WHERE user_id = ?";
		$stmt = mysqli_prepare($this->connect, $query);
		mysqli_stmt_bind_param($stmt, "s", $this->user_id);
		mysqli_stmt_execute($stmt);

		try
		{
			if($result = mysqli_stmt_get_result($stmt))
			{
				$user_data = mysqli_fetch_assoc($result);
			}
			else
			{
				$user_data = array();
			}
		}
		catch (Exception $error)
		{
			echo $error->getMessage();
		}
		return $user_data;
	}

	function upload_image($user_profile)
	{
		$extension = explode('.', $user_profile['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = 'images/' . $new_name;
		move_uploaded_file($user_profile['tmp_name'], $destination);
		return $destination;
	}

	function update_data()
	{
		$query = "UPDATE `chat_user_table` SET `user_name` = ?, `user_email` = ?, `user_password` = ?, `user_profile` = ?  WHERE `user_id` = ?";

		$stmt = mysqli_prepare($this->connect, $query);
		mysqli_stmt_bind_param($stmt, "sssss", $this->user_name, $this->user_email, $this->user_password, $this->user_profile, $this->user_id);

		if(mysqli_stmt_execute($stmt))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function get_user_all_data()
	{
		$query = "SELECT * FROM chat_user_table";
		$stmt = mysqli_prepare($this->connect, $query);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_all($result);

		return $data;
	}

}



?>
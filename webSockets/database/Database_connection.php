<?php

//Database_connection.php

class Database_connection
{
	function connect()
	{
        $username = "root";
        $password = "db_password";
        $db_name = "chat";
        $server = "172.17.0.1";

        $connect = mysqli_connect($server, $username, $password, $db_name, 3306);

        if (mysqli_connect_errno()) {
            echo("Connect failed: %s\n" . mysqli_connect_error());
            die();
        }

		return $connect;
	}
}

?>
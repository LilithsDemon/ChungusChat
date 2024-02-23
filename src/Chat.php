<?php

//Chat.php

namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
require dirname(__DIR__) . "/classes/user.php";
session_start();

class Chat implements MessageComponentInterface {
    protected $clients;
    public $user_object;


    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo 'Server Started';
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        echo 'Server Started';
        $this->user_object = new \ChatUser($_SESSION['userID']);
        $this->clients->attach($conn, $this->user_object);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if(isset($data['status'])) return "Connection renewed!";
        if(isset($data['update']))
        {
            $this->user_object->updateData();
            return "Data Updated!";
        }
        foreach ($this->clients as $client) {
            if ($data['from'] != $client->getUserID()) {
                $user_rooms = $client->getRooms();
                if(in_array($data['room'], $user_rooms)) $client->send($msg);
            } else $client->send($msg);
        }
        return 1;
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}

?>

<?php//Includes the namespaces for the application.
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
//Auto-load the Composer 
components.require __DIR__ . '/vendor/autoload.php';
//The class that will be used to handle the connections.
class Chat implements MessageComponentInterface{    
    //The array that will hold the connections.    
    protected $clients;    
    //The constructor for the class.    
    public function __construct()    {        $this->clients = new \SplObjectStorage;    }    
    //This method can be used to send a message to all the connected clients.    
    public function sendMsgToAll($msg)    {        foreach ($this->clients as $client)        {            $client->send("System: " . $msg);        }    }    
    //This method is called when a new message is sent.    
    public function onMessage(ConnectionInterface $from, $msg)    {        foreach ($this->clients as $client)        {            $prefix = ($from == $client) ? "Me: " : "User: ";            $client->send($prefix . $msg);        }    }    
    //This method is called when a new connection is made.    
    public function onOpen(ConnectionInterface $conn)    {        $this->clients->attach($conn);        $this->sendMsgToAll("A user has joined the chat.");    }    
    //This method is called when a connection is closed.    
    public function onClose(ConnectionInterface $conn)    {        $this->clients->detach($conn);        $this->sendMsgToAll("A user has left the chat.");    }    
    //This method is called when an error occurs.    
    public function onError(ConnectionInterface $conn, \Exception $e)    {        echo $e;        $conn->close();    }}echo "WebSocket Server is running...\n";
    //The server that will be used to handle the connections.
    //It is set to listen on port 8080.
    $app = new Ratchet\App('localhost', 8080);
    //This will add the Chat class to the server at the /chat path.
    $app->route('/chat', new Chat, array('*'));
    //Start the server.$app->run();?>
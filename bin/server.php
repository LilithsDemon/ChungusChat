<?php

//This is a server that is ran to allow websockets to be used in the chat application

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

    require dirname(__DIR__) . '/vendor/autoload.php';

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8080 // This is the port it is ran on, useful for later when trying to connect in JS
    );

    $server->run();
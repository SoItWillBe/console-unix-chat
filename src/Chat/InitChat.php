<?php

namespace V\ChatV2\Chat;

class InitChat
{
    public function client(): void
    {
        $client = new SocketClient();
        $client->launchChat();
    }

    public function server(): void
    {
        $server = new SocketServer();
        $server->launchChat();
    }
}
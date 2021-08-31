<?php

namespace V\ChatV2\Chat;

use V\ChatV2\Interfaces\SocketChatInterface;

class SocketClient implements SocketChatInterface
{
    private Socket $socket;

    public function __construct()
    {
        $this->initSocket();
    }

    /**
     * @throws \Exception
     */
    public function initSocket()
    {
        $this->socket = new Socket();
        $this->socket->createSocket();
        $this->socket->connectClientToSocket();
    }

    public function launchChat(): void
    {
        do {
            $this->socket->write(false, $this->socket->consoleInput());
            printf("\nMessage from host ->\t%s\n", $this->socket->read(false));
        } while (true);
    }
}
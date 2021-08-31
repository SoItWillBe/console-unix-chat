<?php

namespace V\ChatV2\Chat;

use V\ChatV2\Interfaces\SocketChatInterface;

class SocketServer implements SocketChatInterface
{
    private Socket $socket;

    /**
     * @throws \Exception
     */
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
        $this->socket->destroySocket();
        $this->socket->createSocket();
        $this->socket->bindSocket();
        $this->socket->listenSocket(12);

        echo "Waiting for incoming connections...\n";
    }

    public function launchChat(): void
    {
        do {
            echo "\nSTART POSITION\n";
            $this->socket->acceptSocket();
            $message = $this->socket->read(true, 1024000);

            echo "\nAFTER READING POSITION\n";

            if ($this->socket->consoleInput() === 'exit') break;
            if (empty($this->socket->consoleInput())) continue;


            printf("User ->\t%s\n", $message);
            echo "Write answer\t";
            echo "\nBEFORE WRITING\n";

            $this->socket->write(true, $this->socket->consoleInput());
        } while (true);

        $this->socket->closeConnection();
    }
}
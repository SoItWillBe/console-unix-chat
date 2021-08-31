<?php

namespace V\ChatV2\Chat;

class Socket
{
    private $socket;
    private $acceptedSocket;
    private bool $socketListening;
    private bool $connectedClient;
    private bool $bindedSocket;
    private string $pathToSocket;

    /**
     * @param string|null $pathToSocket
     * @throws \Exception
     */
    public function createSocket(string $pathToSocket = null)
    {
        $this->pathToSocket = ($pathToSocket) ?? __DIR__ . '/../SocketFile/chat.sock';

        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (false === $this->socket) {
            throw new \Exception('Unable to create new socket');
        }
    }

    /**
     *
     */
    public function bindSocket(int $port = 0): void
    {
        $this->bindedSocket = socket_bind($this->socket, $this->pathToSocket, $port);
    }

    /**
     *
     */
    public function listenSocket(int $backlog = 10): void
    {
        $this->socketListening = socket_listen($this->socket, $backlog);
    }

    /**
     * For socket server
     */
    public function acceptSocket(): void
    {
        $this->acceptedSocket = socket_accept($this->socket);
        echo "\nClient connected\n";
    }

    /**
     *
     */
    public function connectClientToSocket()
    {
        $this->connectedClient = socket_connect($this->socket, $this->pathToSocket);
    }

    /**
     * @param string|null $pathToSocket
     * @return void
     */
    public function destroySocket(string $pathToSocket = null): void
    {
        $pathToSocket = $pathToSocket ?? __DIR__ . '/../SocketFile/chat.sock';
        if (file_exists($pathToSocket)) unlink($pathToSocket);
    }

    public function write(bool $acceptedNeeded, string $message): bool
    {
        $socket = ($acceptedNeeded) ? $this->acceptedSocket : $this->socket;

        echo "\nsocket_write done\n";
        return socket_write($socket, $message, strlen($message));
    }

    public function read(bool $acceptedNeeded, $readLen = 250)
    {
        $socket = ($acceptedNeeded) ? $this->acceptedSocket : $this->socket;

        return socket_read($socket, $readLen);
    }

    public function closeConnection()
    {
        socket_close($this->socket);
    }

    public function consoleInput(): string
    {
        return rtrim(fgets(STDIN));
    }
}
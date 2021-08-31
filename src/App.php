<?php

namespace V\ChatV2;

use V\ChatV2\Chat\InitChat;

class App
{
    /**
     * @throws \Exception
     */
    public function run(array $arguments = []): void
    {
        if (!$this->argumentIsCorrect($arguments[1])) {
            throw new \Exception("\n\tExpected argument: [client | server].\n");
        }
        $this->launchChat("{$arguments[1]}");
    }

    private function launchChat(string $side): void
    {
        $chat = new InitChat();
        $chat->$side();
    }

    private function argumentIsCorrect(string $argument): bool
    {
        return (
            $argument === 'client' ||
            $argument === 'server'
        );
    }
}
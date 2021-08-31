<?php

namespace V\ChatV2\Interfaces;

interface SocketChatInterface
{
    public function initSocket();

    public function launchChat(): void;
}
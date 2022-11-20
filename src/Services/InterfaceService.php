<?php

namespace App\Services;

use App\Model\Message;

interface InterfaceService
{
    public function all(): array;

    public function setItem(array $data): Message;
}
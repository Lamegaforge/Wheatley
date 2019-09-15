<?php

namespace App\Services;

class SupervisorService
{
    protected $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function isLock(string $botName) :bool
    {
        $fileName = $this->getFileName($botName);

        return $this->storage->has($fileName);
    }

    public function lock(string $botName, string $message)
    {
        $fileName = $this->getFileName($botName);

        $this->storage->put($fileName, $message);
    }

    protected function getFileName($botName) :string
    {
        return $botName . '.txt';
    }
}

<?php

namespace App\Managers\Twitter;

use App\Managers\Twitter\Contracts\Driver;

class Repository
{
    protected $driver;

    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }

    public function getUserTimeline(string $screenName) :array
    {
        return $this->driver->getUserTimeline($screenName);
    }
}

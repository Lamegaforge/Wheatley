<?php

namespace App\Managers\Twitter;

use Illuminate\Support\Manager;
use App\Managers\Twitter\Contracts\Driver;

class TwitterManager extends Manager
{
    public function createThujohnDriver()
    {
        $config = [];

        $driver = new Drivers\Thujohn($config);

        return $this->getRepository($driver);
    }
   
    public function getRepository(Driver $driver)
    {
        return new Repository($driver);
    }

    public function getDefaultDriver()
    {
        return $this->app['config']['manager']['twitter']['default_driver'];
    }
}
<?php

namespace App\Managers\Twitter;

use DeGraciaMathieu\Manager\Manager;
use App\Managers\Twitter\Contracts\Driver;

class TwitterManager extends Manager
{
    public function createThujohnDriver()
    {
        $config = [];

        $driver = new Drivers\Thujohn($config);

        return $this->getRepository($driver);
    }
   
    public function createMockDriver()
    {
        $config = [];

        $driver = new Drivers\Mock($config);

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
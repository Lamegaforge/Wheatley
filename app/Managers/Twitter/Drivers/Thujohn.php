<?php

namespace App\Managers\Twitter\Drivers;

use App\Managers\Twitter\Tweet;
use Thujohn\Twitter\Facades\Twitter;
use App\Managers\Twitter\Contracts\Driver;

class Thujohn implements Driver
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getUserTimeline($screenName) :array
    {
        $parameters = [
            'screen_name' => $screenName, 
            'count' => 30, 
            'format' => 'array',
            'include_rts' => false,
            'exclude_replies' => false
        ];

        return Twitter::getUserTimeline($parameters);
    }    
}

<?php

namespace App\Managers\Twitter\Drivers;

use RunTimeException;
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
        try {
            
            $parameters = [
                'screen_name' => $screenName, 
                'count' => 30, 
                'format' => 'array',
                'include_rts' => false,
                'exclude_replies' => false,
                'tweet_mode' => 'extended',
            ];

            return Twitter::getUserTimeline($parameters);

        } catch (RunTimeException $e) {
            return [];
        }
    }    
}

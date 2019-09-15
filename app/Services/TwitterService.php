<?php

namespace App\Services;

use App\Managers\Twitter\TwitterManager;

class TwitterService
{
    protected $twitterManager;

    public function __construct(TwitterManager $twitterManager)
    {
        $this->twitterManager = $twitterManager;
    }

    public function getUserTimeline(string $screenName) :array
    {
        $tweets = $this->twitterManager->driver('thujohn')->getUserTimeline($screenName);

        $tweets = $this->purgeUselessTweets($tweets);

        return $tweets;
    }

    protected function purgeUselessTweets(array $tweets) :array
    {
        return array_filter($tweets, function ($tweet) {
            return in_array('lamegaforge', array_pluck($tweet['entities']['hashtags'], 'text'), true);
        });
    }
}

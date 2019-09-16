<?php

namespace App\Listeners;

use App\Events\TweetHasBeenSend;
use App\Repositories\TweetRepository;

class SaveSendedTweet
{
    protected $tweetRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TweetHasBeenSend $event)
    {
        $this->tweetRepository->create([
            'hash' => $event->tweet['id'],
            'text' => $event->tweet['full_text'],
        ]);
    }
}

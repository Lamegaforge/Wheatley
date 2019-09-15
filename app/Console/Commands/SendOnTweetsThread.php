<?php

namespace App\Console\Commands;

use Config;
use Exception;
use Illuminate\Console\Command;
use App\Exceptions\BotException;
use App\Services\TwitterService;
use Illuminate\Support\Collection;
use App\Services\SupervisorService;
use App\Repositories\TweetRepository;
use App\Services\DiscordEmbedService;
use App\Services\DiscordWebhookService;

class SendOnTweetsThread extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discord:send-on-tweets-thread';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    
    public function handle()
    {
        $this->botIsFree();

        try {

            $tweetsAlreadySended = $this->getTweetsAlreadySended();

            foreach (Config::get('discord.twitter_accounts_of_assholes') as $username) {

                $tweets = app(TwitterService::class)->getUserTimeline($username);

                $tweets = $this->purgeAlreadySendedTweets($tweetsAlreadySended, $tweets);

                $this->send($tweets);
            }

        } catch (Exception $exception) {
            app(SupervisorService::class)->lock('tweets-aggregator', $exception);
        }
    }

    protected function botIsFree()
    {
        $isLocked = app(SupervisorService::class)->isLock('tweets-aggregator');

        throw_if($isLocked, BotException::class, 'tweets-aggregator is locked.');
    }

    protected function getTweetsAlreadySended() :Collection
    {
        $tweetsAlreadySended = app(TweetRepository::class)->all();

        $tweetsAlreadySended = new Collection($tweetsAlreadySended['data']);

        return $tweetsAlreadySended->keyBy('hash');
    }

    protected function purgeAlreadySendedTweets(Collection $tweetsAlreadySended, array $tweets) :array
    {
        $tweets = (new Collection($tweets))->keyBy('id');

        $diff = $tweets->diffKeys($tweetsAlreadySended);

        return $diff->all();
    }

    protected function send(array $tweets)
    {
        foreach ($tweets as $tweet) {

            $embed = app(DiscordEmbedService::class)->makeTweetEmbed($tweet);

            app(DiscordWebhookService::class)->sendOnTweetsThread($embed);

            app(TweetRepository::class)->create([
                'hash' => $tweet['id'],
                'text' => $tweet['full_text'],
            ]);
        }
    }
}

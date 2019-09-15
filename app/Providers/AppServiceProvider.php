<?php

namespace App\Providers;

use Storage;
use GuzzleHttp\Client;
use App\Services\TwitterService;
use App\Services\SupervisorService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\DiscordWebhookService;
use App\Managers\Twitter\TwitterManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TwitterManager::class, function ($app) {
            return new TwitterManager($app);
        });

        $this->app->singleton(TwitterService::class, function ($app) {
            return new TwitterService(app(TwitterManager::class));
        });

        $this->app->singleton(DiscordWebhookService::class, function ($app) {
            return new DiscordWebhookService(new Client, $app['config']['discord']);
        });

        $this->app->singleton(SupervisorService::class, function ($app) {
            return new SupervisorService(Storage::disk('supervisor'));
        });          
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}

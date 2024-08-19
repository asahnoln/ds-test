<?php

namespace App\Providers;

use App\Clients\GitHubClient;
use App\Contracts\FollowerServiceInterface;
use App\Contracts\GitHubClientInterface;
use App\Services\FollowerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        GitHubClientInterface::class => GitHubClient::class,
        FollowerServiceInterface::class => FollowerService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

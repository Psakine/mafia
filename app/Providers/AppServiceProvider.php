<?php

namespace App\Providers;

use App\Contracts\GameContract;
use App\Contracts\PlayerContract;
use App\Services\GameService;
use App\Services\PlayerService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PlayerContract::class, PlayerService::class);
        $this->app->singleton(GameContract::class, GameService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}

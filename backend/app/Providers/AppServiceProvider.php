<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected array $injectable = [
        \App\Repository\Interfaces\TrappingRainWaterRepositoryInterface::class => \App\Repository\TrappingRainWater\TrappingRainWaterRepository::class,
    ];
     
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach($this->injectable as $interface => $repository){
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

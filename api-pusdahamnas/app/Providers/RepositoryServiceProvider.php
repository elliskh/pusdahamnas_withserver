<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.
        $this->app->bind(
            'App\Interfaces\ApiKeyInterface',
            'App\Repositories\ApiKeyRepository'
        );

        $this->app->bind(
            'App\Interfaces\AuthInterface',
            'App\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Interfaces\DokumenInterface',
            'App\Repositories\DokumenRepository'
        );

        $this->app->bind(
            'App\Interfaces\InfografisInterface',
            'App\Repositories\InfografisRepository'
        );

        $this->app->bind(
            'App\Interfaces\GlosariumInterface',
            'App\Repositories\GlosariumRepository'
        );

        $this->app->bind(
            'App\Interfaces\LembagaHAMInterface',
            'App\Repositories\LembagaHAMRepository'
        );

        $this->app->bind(
            'App\Interfaces\AhliHAMInterface',
            'App\Repositories\AhliHAMRepository'
        );
    }
}
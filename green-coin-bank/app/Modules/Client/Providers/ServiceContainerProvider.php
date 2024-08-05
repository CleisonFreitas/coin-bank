<?php

namespace App\Modules\Client\Providers;

use App\Modules\Client\Contracts\AssetContract;
use App\Modules\Client\Services\AssetService;
use Illuminate\Support\ServiceProvider;

class ServiceContainerProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AssetService::class, function ($app) {
            return new AssetService(
                $app->make(AssetContract::class)
            );
        });
    }
}
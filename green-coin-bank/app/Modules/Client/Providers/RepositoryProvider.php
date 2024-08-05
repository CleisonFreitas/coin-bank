<?php
namespace App\Modules\Client\Providers;

use App\Modules\Client\Contracts\AssetContract;
use App\Modules\Client\Repositories\ListAssetRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(AssetContract::class, ListAssetRepository::class);
    }

    public function boot(): void
    {}
}

<?php

use App\Modules\Client\Controllers\AssetsController;
use Illuminate\Support\Facades\Route;

Route::controller(AssetsController::class)
    ->prefix('client')
    ->group(function ($router) {
        $router->get('assets', 'index');
        $router->get('assets/search', 'findByTerm');
    });

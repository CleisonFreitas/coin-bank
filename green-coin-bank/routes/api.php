<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    require __DIR__ . './../app/Modules/Common/Routes/client.php';
});

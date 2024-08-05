<?php

namespace App\Modules\Client\Services\Storage;

use Illuminate\Support\Facades\Cache;

final class CacheService
{
    /**
     * Store the values into redis cache.
     * 
     * @param int|string $key
     * @param mixed $value
     * @param float $time
     * @return void
     */
    public static function store(int|string $key, mixed $value, float $time = 86400): void
    {
        if (Cache::has($key)) Cache::delete($key);
        Cache::set($key, $value, $time);
    }

    /**
     * Retrieve the value of the cache.
     * @param int|string $key
     * @return mixed
     */
    public static function retrieve(int|string $key): mixed
    {
        return Cache::get($key);
    }
}
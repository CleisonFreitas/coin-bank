<?php

declare(strict_types=1);

namespace App\Modules\Client\Services;

use App\Modules\Client\Contracts\AssetContract;
use App\Modules\Client\Resources\AssetResource;
use App\Modules\Client\Services\Storage\CacheService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class AssetService
{
    protected $key = 'assets';

    public function __construct(
        private readonly AssetContract $listAssetRepository,
    )
    {}

    /**
     * Retrieve the data from repository
     * @param bool $forceConsult
     * @param string $term
     * 
     * @return JsonResource
     * 
     * @throws \Exception
     */
    public function getAll(bool $forceConsult = false, string $term = null): JsonResource
    {
        $data = CacheService::retrieve($this->key);
        if ($forceConsult || !$data) {
            $data = $this->create();
        }

        $items = array_filter($data, function ($item) use ($term) {
            return Str::of($item->asset_id)->trim()->startsWith($term);
        }, ARRAY_FILTER_USE_BOTH);
        $result = $term ? $items : $data;
        return AssetResource::collection($result);
    }

    /**
     * Get data from api and stored into cache.
     * 
     * @return array
     * 
     * @throws \Exception
     */
    public function create(): array
    {
        $data = $this->listAssetRepository->getAllAssets();
        CacheService::store(key: $this->key, value: $data);
        return $data;
    }

    /**
     * Show details of an specific asset.
     * 
     * @param string $term
     * @return array
     */
    public function show(string $term): array
    {
        $data = CacheService::retrieve($this->key);
        $items = array_filter($data, function ($item) use ($term) {
            return Str::of($item->asset_id)->trim()->exactly($term);
        }, ARRAY_FILTER_USE_BOTH);
        return array_values($items);
    }
}
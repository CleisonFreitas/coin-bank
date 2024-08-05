<?php

namespace App\Modules\Client\Repositories;

use App\Modules\Client\Contracts\AssetContract;
use Exception;
use GuzzleHttp\Client;

class ListAssetRepository implements AssetContract
{
    /**
     * Retrieve the data of assets from API.
     * @return array
     * 
     * @throws Exception
     */
    public function getAllAssets(): array
    {
        try {
            $client = new Client();
            $response = $client->request('GET', config('services.coin.url') . '/assets', [
                'headers' => [
                    'Accept' => 'text/plain',
                    'X-CoinAPI-Key' => config('services.coin.key'),
                ],
                'http_errors' => true,
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
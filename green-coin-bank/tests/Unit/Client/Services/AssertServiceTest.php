<?php

namespace Tests\Unit\Client\Services;

use App\Modules\Client\Contracts\AssetContract;
use App\Modules\Client\Services\AssetService;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\Test;
use stdClass;
use Tests\TestCase;

class AssertServiceTest extends TestCase
{
    /**
     * Using a mock to simulate the retrieve of data.
     * 
     * @return void
     */
    #[Test]
    public function it_should_storing_and_showing_assets(): void
    {
        $coin = new stdClass;
        $coin->asset_id = "USD";
        $coin->name = "US Dollar";
        $coin->type_is_crypto = false;
        $coin->last_update = now()->format('Y-m-d');
        $data = array($coin);
        $repositoryMock = $this->createMock(AssetContract::class);
        $repositoryMock->method('getAllAssets')->willReturn($data);
        $service = new AssetService($repositoryMock);
        $service->getAll(forceConsult: true);

        $cache = Cache::get('assets');
        $this->assertEquals($coin->asset_id, $cache[0]->asset_id);
        $this->assertEquals($coin->name, $cache[0]->name);
        $this->assertEquals($coin->type_is_crypto, $cache[0]->type_is_crypto);
        $this->assertEquals($coin->last_update, $cache[0]->last_update);
    }

    /**
     * It should applying a filter to catch an asset
     * by a specific index.
     * 
     * @return void
     */
    #[Test]
    public function it_should_showing_an_asset_by_id(): void
    {
        $data = [];
        $coins = [
            'BTC' => [
                'asset_id' => 'BTC',
                'name' => 'Bitcoin',
                'type_is_crypto' => true,
                'price_in_dolar' => $this->faker->randomNumber(),
                'last_update' => now()->format('Y-m-d')
            ],
            'USD' => [
                'asset_id' => 'USD',
                'name' => 'US Dollar',
                'type_is_crypto' => false,
                'price_in_dolar' => null,
                'last_update' => now()->format('Y-m-d')
            ]
        ];

        foreach ($coins as $key => $coin) {
            $coinData = new stdClass;
            $coinData->asset_id = $key;
            $coinData->name = $coin['name'];
            $coinData->type_is_crypto = $coin['type_is_crypto'];
            $coinData->price_in_dolar = $coin['price_in_dolar'];
            $coinData->last_update = $coin['last_update'];

            $data[] = $coinData;
        }
        Cache::set('assets',$data);
        $index = $this->faker->randomElement(['BTC', 'USD']);
        $foundByIndex = app(AssetService::class)->show($index);
        $this->assertEquals($coins[$index]['asset_id'], $foundByIndex[0]->asset_id);
        $this->assertEquals($coins[$index]['name'], $foundByIndex[0]->name);
        $this->assertEquals($coins[$index]['type_is_crypto'], $foundByIndex[0]->type_is_crypto);
        $this->assertEquals($coins[$index]['last_update'], $foundByIndex[0]->last_update);
    }
}

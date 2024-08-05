<?php

namespace Tests\Feature\Http;

use App\Modules\Client\Contracts\AssetContract;
use App\Modules\Client\Services\Storage\CacheService;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use stdClass;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Support\Str;

class AssetsControllerTest extends TestCase
{
    /**
     * It should the return of apis.
     */
    #[Test]
    public function it_should_testing_the_index_api(): void
    {
        $data = $this->generatingData();
        $this->instance(
            AssetContract::class,
            Mockery::mock(AssetContract::class, function (MockInterface $mock) use ($data) {
                $mock->shouldReceive('getAllAssets')
                    ->once()
                    ->andReturn($data);
            })
        );
        $response = $this->getJson('/api/v1/client/assets');
        $response->assertJsonCount(1);
        $response->assertJsonStructure([
            'data' => [
                0 => [
                    'USD' => [
                        'name',
                        'type_is_crypto',
                        'price_in_dolar',
                        'last_update'
                    ]
                ],
                1 => [
                    'BTC' => [
                        'name',
                        'type_is_crypto',
                        'price_in_dolar',
                        'last_update'
                    ]
                ]
            ]
        ]);
    }

    /**
     * Filter the asset by key.
     */
    #[Test]
    public function it_should_testing_the_show_api(): void
    {
        $data = $this->generatingData();
        CacheService::store('assets', $data);
        $term = $this->faker->randomElement(['btc', 'usd']);
        $response = $this->getJson('/api/v1/client/assets/show?' . http_build_query(['term' => $term]));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            0 => [
                'asset_id',
                'name',
                'price_usd',
                'type_is_crypto',
                'data_quote_start',
                'data_quote_end'
            ]
        ]);
        $this->assertEquals($response->json()[0]['asset_id'], Str::upper($term));
    }

    /**
     * Mocking data to test.
     * 
     * @return array
     */
    private function generatingData(): array
    {
        $data = array();
        $coins = [
            [
                "asset_id" => "USD",
                "name" => "US Dollar",
                "type_is_crypto" => 0,
                "data_quote_start" => "2014-02-24T00:00:00.0000000Z",
                "data_quote_end" => "2024-08-03T00:00:00.0000000Z",
                "data_orderbook_start" => "2014-02-24T17:43:05.0000000Z",
                "data_orderbook_end" => "2023-07-07T00:00:00.0000000Z",
                "data_trade_start" => "2010-07-17T00:00:00.0000000Z",
                "data_trade_end" => "2024-08-03T00:00:00.0000000Z",
                "data_symbols_count" => 345706,
                "volume_1hrs_usd" => 31214407332.59,
                "volume_1day_usd" => 1739260057191.19,
                "volume_1mth_usd" => 269948623748299.4,
                "id_icon" => "0a4185f2-1a03-4a7c-b866-ba7076d8c73b",
                "chain_addresses" => [
                    [
                        "chain_id" => "ETHEREUM",
                        "network_id" => "MAINNET",
                        "address" => "0xd233d1f6fd11640081abb8db125f722b5dc729dc"
                    ]
                ],
                "data_start" => "2010-07-17",
                "data_end" => "2024-08-03"
            ],
            [
                "asset_id" => "BTC",
                "name" => "Bitcoin",
                "type_is_crypto" => 1,
                "data_quote_start" => "2014-02-24T00:00:00.0000000Z",
                "data_quote_end" => "2024-08-03T00:00:00.0000000Z",
                "data_orderbook_start" => "2014-02-24T17:43:05.0000000Z",
                "data_orderbook_end" => "2023-07-07T00:00:00.0000000Z",
                "data_trade_start" => "2010-07-17T00:00:00.0000000Z",
                "data_trade_end" => "2024-08-03T00:00:00.0000000Z",
                "data_symbols_count" => 238305,
                "volume_1hrs_usd" => 277581709180770.44,
                "volume_1day_usd" => 87667464158537360,
                "volume_1mth_usd" => 3.11776223634919e+21,
                "price_usd" => 59014.910169769486,
                "id_icon" => "4caf2b16-a017-4e26-a348-2cea69c34cba",
                "chain_addresses" => [
                    [
                        "chain_id" => "ARBITRUM",
                        "network_id" => "MAINNET",
                        "address" => "0x2f2a2543b76a4166549f7aab2e75bef0aefc5b0f"
                    ],
                    [
                        "chain_id" => "ETHEREUM",
                        "network_id" => "MAINNET",
                        "address" => "0x2260fac5e5542a773aa44fbcfedf7c193bc2c599"
                    ]
                ],
                "data_start" => "2010-07-17",
                "data_end" => "2024-08-03"
            ]
        ];
        foreach ($coins as $key => $coin) {
            $coinData = new stdClass;
            $coinData->asset_id = $coin['asset_id'] ?? null;
            $coinData->name = $coin['name'] ?? null;
            $coinData->type_is_crypto = $coin['type_is_crypto'] ?? 0;
            $coinData->data_quote_start = $coin['data_quote_start'] ?? null;
            $coinData->data_quote_end = $coin['data_quote_end'] ?? null;
            $coinData->data_orderbook_start = $coin['data_orderbook_start'] ?? null;
            $coinData->data_orderbook_end = $coin['data_orderbook_end'] ?? null;
            $coinData->data_trade_start = $coin['data_trade_start'] ?? null;
            $coinData->data_trade_end = $coin['data_trade_end'] ?? null;
            $coinData->data_symbols_count = $coin['data_symbols_count'] ?? null;
            $coinData->volume_1hrs_usd = $coin['volume_1hrs_usd'] ?? null;
            $coinData->volume_1day_usd = $coin['volume_1day_usd'] ?? null;
            $coinData->volume_1mth_usd = $coin['volume_1mth_usd'] ?? null;
            $coinData->price_usd = $coin['price_usd'] ?? null;
            $coinData->id_icon = $coin['id_icon'] ?? null;
            $coinData->chain_addresses = $coin['chain_addresses'] ?? [];
            $coinData->data_start = $coin['data_start'] ?? null;
            $coinData->data_end = $coin['data_end'] ?? null;

            $data[] = $coinData;
        }
        return $data;
    }
}

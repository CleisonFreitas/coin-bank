<?php

namespace Tests\Feature\Integrations;

use App\Modules\Client\Contracts\AssetContract;
use App\Modules\Client\Services\AssetService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use stdClass;
use Tests\TestCase;

class AssetServiceIntegrationTest extends TestCase
{
    /**
     * It should retrive the assets simulating a valid url.
     */
    #[Test]
    public function it_retrieves_assets_correctly()
    {
        $coins = [
            [
                'asset_id' => 'BTC',
                'name' => 'Bitcoin',
                'type_is_crypto' => 1,
                'price_in_dolar' => $this->faker->randomNumber(),
                'data_quote_start' => '2014-02-24T00:00:00.0000000Z',
                'data_quote_end' => '2024-08-02T00:00:00.0000000Z',
                'data_orderbook_start' => '2014-02-24T17:43:05.0000000Z',
                'data_orderbook_end' => '2023-07-07T00:00:00.0000000Z',
                'data_trade_start' => '2010-07-17T00:00:00.0000000Z'
            ],
            [
                'asset_id' => 'USD',
                'name' => 'US Dollar',
                'type_is_crypto' => 0,
                'price_in_dolar' => null,
                'data_quote_start' => '2014-02-24T00:00:00.0000000Z',
                'data_quote_end' => '2024-08-02T00:00:00.0000000Z',
                'data_orderbook_start' => '2014-02-24T17:43:05.0000000Z',
                'data_orderbook_end' => '2023-07-07T00:00:00.0000000Z',
                'data_trade_start' => '2010-07-17T00:00:00.0000000Z'
            ]
        ];
        Http::fake([
            config('services.coin.url') . '/assets' => Http::response($coins, 200)
        ]);
        $response = json_decode(Http::get(config('services.coin.url') . '/assets')->getBody()->getContents());
        $this->instance(
            AssetContract::class,
            Mockery::mock(AssetContract::class, function (MockInterface $mock) use ($response) {
                $mock->shouldReceive('getAllAssets')
                    ->once()
                    ->andReturn($response);
            })
        );
        $result = json_decode(app(AssetService::class)->getAll()->toJson());
        // Assert
        $this->assertCount(2, $result);
        foreach($coins as $key => $coin) {
            $index = $coin['asset_id'];
            $this->assertEquals($coin['name'], $result[$key]->{$index}->name);
            $this->assertEquals($coin['type_is_crypto'], $result[$key]->{$index}->type_is_crypto);
        }
    }
}
<?php

namespace App\Modules\Client\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            $this->asset_id => [
                'name' => $this->name,
                'type_is_crypto' => $this->type_is_crypto == 1 ? true : false,
                'price_in_dolar' => isset($this->price_usd) ? $this->price_usd : null,
                'last_update' => isset($this->data_end) ? $this->data_end : null
            ]  
        ];
    }
}
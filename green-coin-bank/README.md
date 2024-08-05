# GREEN COIN BANK

## API Endpoints

### Get All Assets
- Endpoint: GET /api/v1/client/assets
- Description: Retrieves a list of all cryptocurrency assets.
- Request:
    - Method: GET
    - Headers:
        - Accept: application/json
- Params:
    - Term: (string): The ID of the asset (e.g., BTC). It's going to filter all assets that start with the string informed;
    - ForceConsult: (boolean). It should forcing the api to search for new updates about the assets(It takes more time).
- Response:
    - Status Code: 200 OK;
    - Body:
### Url plus term
```
/api/v1/client/assets?term=btc
```

### Data retrieved
```
     "data": [
        {
            "BTC": {
                "name": "Bitcoin",
                "type_is_crypto": true,
                "price_in_dolar": 59014.910169769486,
                "last_update": "2024-08-03"
            }
        },
        {
            "BTCS": {
                "name": "Bitcoin Scrypt",
                "type_is_crypto": true,
                "price_in_dolar": 0.2044940367311546,
                "last_update": "2024-08-03"
            }
        },
        {
            "BTCU": {
                "name": "BTCU",
                "type_is_crypto": true,
                "price_in_dolar": null,
                "last_update": "2024-04-23"
            }
        },
    ];
```

### Search Asset by ID
- Endpoint: GET /api/v1/client/assets/search
- Description: Retrieves a list of all cryptocurrency assets.
- Request:
    - Method: GET
    - Headers:
        - Accept: application/json
- Params:
    - Term: (string): The ID of the asset (e.g., BTC). It's going to filter a specific asset by his asset_id, then display his details.
- Response:
    - Status Code: 200 OK;
    - Body:
### Url plus term
```
/api/v1/client/assets/search?term=usd
```

### Data retrieved
```
    [
        {
            "asset_id": "USD",
            "name": "US Dollar",
            "type_is_crypto": 0,
            "data_quote_start": "2014-02-24T00:00:00.0000000Z",
            "data_quote_end": "2024-08-03T00:00:00.0000000Z",
            "data_orderbook_start": "2014-02-24T17:43:05.0000000Z",
            "data_orderbook_end": "2023-07-07T00:00:00.0000000Z",
            "data_trade_start": "2010-07-17T00:00:00.0000000Z",
            "data_trade_end": "2024-08-03T00:00:00.0000000Z",
            "data_symbols_count": 345706,
            "volume_1hrs_usd": 31214407332.59,
            "volume_1day_usd": 1739260057191.19,
            "volume_1mth_usd": 269948623748299.4,
            "id_icon": "0a4185f2-1a03-4a7c-b866-ba7076d8c73b",
            "chain_addresses": [
                {
                    "chain_id": "ETHEREUM",
                    "network_id": "MAINNET",
                    "address": "0xd233d1f6fd11640081abb8db125f722b5dc729dc"
                }
            ],
            "data_start": "2010-07-17",
            "data_end": "2024-08-03"
        }
    ]
```

## Contact
For more details, send me an email: cleison51@hotmail.com





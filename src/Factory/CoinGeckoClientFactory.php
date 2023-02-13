<?php

declare(strict_types=1);

namespace Bot\Factory;

use Bot\DTO\ApiConfigDto;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use GuzzleHttp\Client;

class CoinGeckoClientFactory
{
    public function __construct(
        private ApiConfigDto $apiConfig
    ) {
    }

    public function create(): CoinGeckoClient
    {
        $client = new Client([
            'base_uri' => $this->apiConfig->getBaseUri(),
            'headers' => [
                'x-cg-pro-api-key' => $this->apiConfig->getApiKay() ?? ''
            ]
        ]);

        return new CoinGeckoClient($client);
    }
}

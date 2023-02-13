<?php

declare(strict_types=1);

namespace Bot\DTO;

class ApiConfigDto
{
    public const API_CONFIG_KAY = 'coingecko_api';
    public const BASE_URI_KAY = 'base_uri';
    public const API_REQUEST_KAY = 'api_kay';

    public function __construct(
        private string $baseUri,
        private ?string $apiKay
    ) {
    }

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    public function getApiKay(): ?string
    {
        return $this->apiKay;
    }
}

<?php

declare(strict_types=1);

namespace Bot\DTO;

class CoinPriceDto
{
    public function __construct(
        private CoinConfigDto $coinConfigDto,
        private string $coinId,
        private array $priceList
    ){
    }

    public function getCoinConfigDto(): CoinConfigDto
    {
        return $this->coinConfigDto;
    }

    public function getPriceList(): array
    {
        return $this->priceList;
    }

    public function getCoinId(): string
    {
        return $this->coinId;
    }
}

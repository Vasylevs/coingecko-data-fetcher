<?php

declare(strict_types=1);

namespace Bot\DTO;

class CoinConfigDto
{
    public const COINS_CONFIG_KAY = 'coins';

    public function __construct(
        private string $coinSymbol,
        private array $currencies
    ){
    }

    public function getCoinSymbol(): string
    {
        return $this->coinSymbol;
    }

    public function getCurrencies(): array
    {
        return $this->currencies;
    }
}

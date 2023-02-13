<?php

declare(strict_types=1);

namespace Bot\Model;

use JsonSerializable;

class CoinInfo implements JsonSerializable
{
    public const TABLE_NAME = 'coin_price';

    public const ID_FILED = 'id';
    public const COIN_ID_FILED = 'coin_id';
    public const COIN_SYMBOL_FILED = 'coin_symbol';
    public const CURRENCIES_FILED = 'currencies';
    public const PRICE_FILED = 'price';
    public const CREATE_AT_FIELD = 'created_at';

    private string $id;
    private string $coinId;
    private string $coinSymbol;
    private string $currencies;
    private float $price;
    private string $createAt;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): CoinInfo
    {
        $this->id = $id;
        return $this;
    }

    public function getCoinId(): string
    {
        return $this->coinId;
    }

    public function setCoinId(string $coinId): CoinInfo
    {
        $this->coinId = $coinId;
        return $this;
    }

    public function getCoinSymbol(): string
    {
        return $this->coinSymbol;
    }

    public function setCoinSymbol(string $coinSymbol): CoinInfo
    {
        $this->coinSymbol = $coinSymbol;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): CoinInfo
    {
        $this->price = $price;
        return $this;
    }

    public function setCurrencies(string $currencies): CoinInfo
    {
        $this->currencies = $currencies;
        return $this;
    }

    public function getCurrencies(): string
    {
        return $this->currencies;
    }

    public function getCreateAt(): string
    {
        return $this->createAt;
    }

    public function setCreateAt(string $createAt): CoinInfo
    {
        $this->createAt = $createAt;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'coinId' => $this->getCoinId(),
            'coinSymbol' => $this->getCoinSymbol(),
            'currencies' => $this->getCurrencies(),
            'price' => $this->getPrice(),
            'timeAt' => $this->getCreateAt()
        ];
    }
}

<?php

declare(strict_types=1);

namespace Bot\Collection;

use Bot\DTO\CoinPriceDto;

class CoinPriceCollection extends AbstractCollection
{
    /**
     * @param CoinPriceDto $coinPrice
     */
    public function add($coinPrice)
    {
        $this->data[] = $coinPrice;
    }

    /**
     * @return CoinPriceDto
     */
    public function current()
    {
        return $this->data[$this->position];
    }
}

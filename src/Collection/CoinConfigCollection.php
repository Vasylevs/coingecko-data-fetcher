<?php

declare(strict_types=1);

namespace Bot\Collection;

use Bot\DTO\CoinConfigDto;

class CoinConfigCollection extends AbstractCollection
{
    /**
     * @param CoinConfigDto $coinConfigDto
     */
    public function add($coinConfigDto)
    {
        $this->data[] = $coinConfigDto;
    }

    /**
     * @return CoinConfigDto
     */
    public function current()
    {
        return $this->data[$this->position];
    }
}

<?php

declare(strict_types=1);

namespace Bot\Factory;

use Bot\Collection\CoinConfigCollection;
use Bot\DTO\CoinConfigDto;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CoinConfigCollectionFactory
{
    public function __construct(
        private ContainerInterface $container
    ) {
    }

    public function create(): CoinConfigCollection
    {
        $configArray = $this->container->getParameter(CoinConfigDto::COINS_CONFIG_KAY);
        $coinConfigCollection = new CoinConfigCollection();

        if (empty($configArray)) {
            throw new \InvalidArgumentException('Coins config can`t be empty');
        }

        foreach ($configArray as $coinSymbol => $currencies) {
            $coinConfigCollection->add(
                new CoinConfigDto(
                    $coinSymbol,
                    explode(',', $currencies)
                )
            );
        }

        return $coinConfigCollection;
    }
}

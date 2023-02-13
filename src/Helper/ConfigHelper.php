<?php

declare(strict_types=1);

namespace Bot\Helper;

use Bot\DTO\CoinConfigDto;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ConfigHelper
{
    public static function getCoinSymbol(ParameterBagInterface $parameterBag): ?array
    {
        $coinsConfig = $parameterBag->get(CoinConfigDto::COINS_CONFIG_KAY);

        if (empty($coinsConfig)) {
            return null;
        }

        return array_keys($coinsConfig);
    }
}

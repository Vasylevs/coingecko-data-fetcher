<?php

declare(strict_types=1);

namespace Bot;

use Bot\Service\CoinDataFetcher;
use Bot\Service\CoinDataProcessor;
use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\IniFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CoinGeckoApp
{
    private YamlFileLoader $yamlFileLoader;
    private ContainerBuilder $containerBuilder;
    private IniFileLoader $iniFileLoader;

    /**
     * @param string $configPath type file only .ini
     * @throws Exception
     */
    public function __construct(string $configPath)
    {
        $this->containerBuilder = new ContainerBuilder();
        $this->yamlFileLoader = new YamlFileLoader($this->containerBuilder, new FileLocator(__DIR__));
        $this->yamlFileLoader->load('config/services.yaml');

        $this->iniFileLoader = new IniFileLoader($this->containerBuilder, new FileLocator(__DIR__));
        $this->iniFileLoader->load($configPath);
    }

    /**
     * @throws Exception
     */
    public function getCoinDataFetcher(): CoinDataFetcher
    {
        return $this->containerBuilder->get('coin_gecko.service.data_fetcher');
    }

    /**
     * @throws Exception
     */
    public function getCoinDataProcessor(): CoinDataProcessor
    {
        return $this->containerBuilder->get('coin_gecko.service.coin_data_processor');
    }

    public function getConfig(): ParameterBagInterface
    {
        return $this->containerBuilder->getParameterBag();
    }
}

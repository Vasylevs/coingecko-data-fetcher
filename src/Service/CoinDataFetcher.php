<?php

declare(strict_types=1);

namespace Bot\Service;

use Bot\Collection\CoinPriceCollection;
use Bot\DTO\CoinPriceDto;
use Exception;
use Bot\Collection\CoinConfigCollection;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class CoinDataFetcher
{
    private const COIN_LIST_CACHE_KAY = 'coins_list';

    /**
     * @throws Exception
     */
    public function __construct(
        private CoinGeckoClient $coinGeckoClient,
        private CoinConfigCollection $coinConfigCollection,
        private FilesystemAdapter $cache
    ) {
    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getCoinPriceList(): CoinPriceCollection
    {
        $coinPriceCollection = new CoinPriceCollection();

        $coinsList = $this->getCoinList();
        $needleCoinIds = [];
        $needleCurrencies = [];
        $coinIdToSymbol = [];

        foreach ($coinsList as $coin) {
            foreach ($this->coinConfigCollection as $coinConfig) {
                if (strtolower($coinConfig->getCoinSymbol()) === strtolower($coin['symbol'])) {
                    $needleCoinIds[] = $coin['id'];
                    $coinIdToSymbol[$coin['id']] = $coinConfig->getCoinSymbol();
                    $needleCurrencies = array_merge($needleCurrencies, $coinConfig->getCurrencies());
                    break;
                }
            }
        }

        $needleCurrencies = array_unique($needleCurrencies);

        $coinPriceList = $this->coinGeckoClient->simple()->getPrice(
            implode(',', $needleCoinIds),
            implode(',', $needleCurrencies)
        );

        foreach ($this->coinConfigCollection as $coinConfig) {
            foreach ($coinPriceList as $coinId => $prices) {
                if (isset($coinIdToSymbol[$coinId])
                    && $coinConfig->getCoinSymbol() === $coinIdToSymbol[$coinId]
                    && !empty($prices)
                ) {
                    $coinPriceCollection->add(new CoinPriceDto(
                        $coinConfig,
                        $coinId,
                        $prices
                    ));
                }
            }
        }

        return $coinPriceCollection;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getCoinList()
    {
        return $this->cache->get(self::COIN_LIST_CACHE_KAY, function (ItemInterface $item) {
            $item->expiresAfter(3600);

            $this->coinGeckoClient->ping();
            return $this->coinGeckoClient->coins()->getList();
        });
    }

    /**
     * @throws InvalidArgumentException
     */
    public function clearCoinListCache()
    {
        $this->cache->delete(self::COIN_LIST_CACHE_KAY);
    }
}

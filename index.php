<?php

use Bot\CoinGeckoApp;
use Bot\Helper\ConfigHelper;
use GuzzleHttp\Exception\ClientException;

require_once './vendor/autoload.php';

try {
    $coinGeckoApp = new  CoinGeckoApp(__DIR__ . '/config.ini');
    $coinPriceCollection = $coinGeckoApp->getCoinDataFetcher()->getCoinPriceList();

    if (!$coinPriceCollection->isEmpty()) {
        $coinGeckoApp->getCoinDataProcessor()->saveToDataBase($coinPriceCollection);
    }

    $needCoinSymbolList = ConfigHelper::getCoinSymbol($coinGeckoApp->getConfig());

    if (null !== $needCoinSymbolList) {
        $coinInfoList = $coinGeckoApp->getCoinDataProcessor()->getLatestCoinPriceBySymbol($needCoinSymbolList);
        dump($coinInfoList);
    }

} catch (ClientException $clientException) {
    dump('CoinGecko service error');
    dump("Error code: " . $clientException->getCode());
    dump("Error message: " . $clientException->getMessage());
} catch (Exception $exception) {
    dump($exception->getMessage());
    dump("File: " . $exception->getFile() . " Line: " . $exception->getLine());
} catch (\Psr\Cache\InvalidArgumentException $exception) {
    dump('Cache error: ' . $exception->getMessage());
    dump("File: " . $exception->getFile() . " Line: " . $exception->getLine());
}


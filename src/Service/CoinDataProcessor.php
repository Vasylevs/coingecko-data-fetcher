<?php

declare(strict_types=1);

namespace Bot\Service;

use Bot\Collection\CoinPriceCollection;
use Bot\Model\CoinInfo;

class CoinDataProcessor
{
    public function __construct(
        private DataBaseProcessor $dataBaseProcessor
    ) {
    }

    public function saveToDataBase(CoinPriceCollection $coinPriceCollection)
    {
        foreach ($coinPriceCollection as $coinPriceDto) {
            foreach ($coinPriceDto->getCoinConfigDto()->getCurrencies() as $currency) {
                if (!empty($coinPriceDto->getPriceList()[strtolower($currency)])) {
                    $this->dataBaseProcessor->insert(
                        CoinInfo::TABLE_NAME,
                        [
                            CoinInfo::COIN_ID_FILED => $coinPriceDto->getCoinId(),
                            CoinInfo::COIN_SYMBOL_FILED => $coinPriceDto->getCoinConfigDto()->getCoinSymbol(),
                            CoinInfo::CURRENCIES_FILED => strtolower($currency),
                            CoinInfo::PRICE_FILED => $coinPriceDto->getPriceList()[strtolower($currency)]
                        ]
                    );
                }
            }
        }
    }

    /**
     * @param string[] $coinSymbolList
     * @return CoinInfo[]
     */
    public function getLatestCoinPriceBySymbol(array $coinSymbolList): array
    {
        $coinInfoModelList = [];

        $coinSymbolString = '';
        foreach ($coinSymbolList as $coinSymbol) {
            $coinSymbolString .= "'" . $coinSymbol . "', ";
        }

        $coinSymbolString = preg_replace('/, $/', '', $coinSymbolString);

        $result = $this->dataBaseProcessor
            ->query("SELECT * FROM " . CoinInfo::TABLE_NAME . " AS cp
                    WHERE cp." . CoinInfo::COIN_SYMBOL_FILED . " IN (" . $coinSymbolString . ")
                        AND cp." . CoinInfo::CREATE_AT_FIELD . " = (
                            SELECT max(cp2." . CoinInfo::CREATE_AT_FIELD . ")
                            FROM " . CoinInfo::TABLE_NAME . " AS cp2
                            WHERE cp2." . CoinInfo::COIN_ID_FILED . " = cp." . CoinInfo::COIN_ID_FILED . "
                              AND cp2." . CoinInfo::CURRENCIES_FILED . " = cp." . CoinInfo::CURRENCIES_FILED . "
                );");

        if ($result !== null) {
            foreach ($result as $coinInfo) {
                $coinInfoModel = new CoinInfo();

                $coinInfoModel->setId($coinInfo[CoinInfo::ID_FILED])
                    ->setCoinId($coinInfo[CoinInfo::COIN_ID_FILED])
                    ->setCoinSymbol($coinInfo[CoinInfo::COIN_SYMBOL_FILED])
                    ->setCurrencies($coinInfo[CoinInfo::CURRENCIES_FILED])
                    ->setPrice(round((float)$coinInfo[CoinInfo::PRICE_FILED], 2))
                    ->setCreateAt($coinInfo[CoinInfo::CREATE_AT_FIELD]);

                $coinInfoModelList[] = $coinInfoModel;
            }
        }

        return $coinInfoModelList;
    }
}

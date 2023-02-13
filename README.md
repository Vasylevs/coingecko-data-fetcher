# Coin Gecko App
****
**Service can fetch coin price data from https://www.coingecko.com api**

### Config guide

copy sample config file
```bash
cp sample.config.ini config.ini
```

**config url for database. Use PostgreSQL**\
```ini
db_url = postgres://<user>:<password>@<host>/<database>
```

**config for coingecko api.**
**if use pro api, you must change base_uri and change config filed - _api_kay_. More info in https://apiguide.coingecko.com/exclusive-endpoints/pro-api**
```ini
coingecko_api[base_uri] = 'https://api.coingecko.com'
coingecko_api[api_kay] = ''
```

**Config info for coin wot need processing. Array key - coin symbol. Multiple currencies can be specified separated by commas**
```ini
coins['BTC'] = USD,EUR,PLN
coins['ETH'] = USD
coins['XMR'] = USD
```

### Config use app

**init app. Need get path for config fire. Type config file - _.ini_**
```php
$coinGeckoApp = new  Bot\CoinGeckoApp(__DIR__ . '/config.ini');
```

****Fetch data from coingecko api. Use config coins and coingecko_api config section****
```php
$coinPriceCollection = $coinGeckoApp->getCoinDataFetcher()->getCoinPriceList();
```

**Sale coin info in db. Parameter - \Bot\Collection\CoinPriceCollection. Use db_url config section from .ini file**
```php
$coinGeckoApp->getCoinDataProcessor()->saveToDataBase($coinPriceCollection);
```

**Fetch coin info from db by coin symbol. Result - last records coin info from all currencies which in db for coin**
```php
$needCoinSymbolList = ['BTC', 'ETH'];
$coinInfoList = $coinGeckoApp->getCoinDataProcessor()->getLatestCoinPriceBySymbol($needCoinSymbolList);
```

#### example use can see in **index.php** file

#### **schema.sql** - db schema and example info

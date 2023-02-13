<?php

declare(strict_types=1);

namespace Bot\Service;

use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DataBaseProcessor
{
    private const DATA_BASE_URL_CONFIG_KAY = 'db_url';

    private const COUNT_RECONNECT = 3;

    private string $databaseUrl;
    /** @var false|resource */
    private $connection = false;

    public function __construct(
        private ContainerInterface $container
    ){
        $this->databaseUrl = (string) $this->container->getParameter(self::DATA_BASE_URL_CONFIG_KAY);
    }

    /**
     * @return mixed
     */
    public function insert(string $table, array $values)
    {
        if (false === $this->connection) {
            $this->connect();
        }

        return pg_insert($this->connection, $table, $values);
    }

    public function query(string $query): ?array
    {
        if (false === $this->connection) {
            $this->connect();
        }

        $result = pg_query($this->connection, $query);

        if (false === $result) {
            return null;
        }

        return pg_fetch_all(result: $result);
    }

    /**
     * @throws RuntimeException
     */
    public function connect(int $countReconnect = self::COUNT_RECONNECT)
    {
        $this->connection = pg_connect($this->databaseUrl);

        if (false === $this->connection && $countReconnect === 0) {
            throw new RuntimeException('Can`t connect for db!');
        }

        if (false === $this->connection) {
            $this->connect(--$countReconnect);
        }
    }

    public function closeConnection(): bool
    {
        if (false !== $this->connection){
            return pg_close($this->connection);
        }

        return false;
    }

    /**
     * @return false|resource
     */
    public function getConnection()
    {
        return $this->connection;
    }
}

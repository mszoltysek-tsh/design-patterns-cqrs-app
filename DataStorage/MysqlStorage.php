<?php
declare(strict_types=1);

namespace DataStorage;

class MysqlStorage implements DataStorageInterface
{
    /**
     * @param string $query
     *
     * @return array
     */
    public function executeQuery(string $query): array
    {
        // TODO: Implement executeQuery() method.
    }
}
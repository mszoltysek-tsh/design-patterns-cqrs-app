<?php
declare(strict_types=1);

namespace Infrastructure\DataStorage;

class ElasticStorage implements DataStorageInterface
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
<?php
declare(strict_types=1);

namespace DataStorage;

interface DataStorageInterface
{
    /**
     * @param string $query
     *
     * @return array
     */
    public function executeQuery(string $query): array;
}
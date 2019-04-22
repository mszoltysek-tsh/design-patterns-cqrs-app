<?php
declare(strict_types=1);

namespace Repository;

interface RepositoryInterface
{
    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param int $id
     */
    public function find(int $id);
}
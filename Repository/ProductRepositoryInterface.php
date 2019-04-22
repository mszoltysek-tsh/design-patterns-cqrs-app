<?php
declare(strict_types=1);

namespace Repository;

use Model\Product;

interface ProductRepositoryInterface extends RepositoryInterface
{
    /**
     * @return array|Product[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     *
     * @return Product|null
     */
    public function find(int $id): ?Product;

    /**
     * @param Product $product
     */
    public function increaseViewCount(Product $product): void;
}
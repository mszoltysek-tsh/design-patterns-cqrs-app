<?php
declare(strict_types=1);

namespace Repository;

use DataStorage\DataStorageInterface;
use Model\Product;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var DataStorageInterface
     */
    private $storage;

    /**
     * ProductRepository constructor.
     *
     * @param DataStorageInterface $storage
     */
    public function __construct(DataStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @inheritdoc
     */
    public function find(int $id): ?Product
    {
        // TODO: Implement find() method.
    }

    /**
     * @param Product $product
     */
    public function increaseViewCount(Product $product): void
    {
        // TODO: Implement increaseViewCount() method.
    }

    /**
     * @return array
     */
    public function getAllProductIds(): array
    {
        return [];
    }
}
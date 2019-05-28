<?php
declare(strict_types=1);

namespace Infrastructure\Repository;

use Infrastructure\DataStorage\DataStorageInterface;
use Model\Product;
use Repository\ProductRepositoryInterface;
use Repository\RepositoryInterface;

class MysqlProductRepository implements ProductRepositoryInterface
{
    use ChainedProductRepositoryTrait;

    /**
     * @var DataStorageInterface
     */
    private $storage;

    /**
     * MysqlProductRepository constructor.
     *
     * @param DataStorageInterface     $storage
     * @param null|RepositoryInterface $nextRepository
     */
    public function __construct(DataStorageInterface $storage, ?RepositoryInterface $nextRepository = null)
    {
        $this->storage = $storage;
        $this->nextRepository = $nextRepository;
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        // TODO: Implement findAll() method.
        if (true /* sth */) {
            return $this->nextRepository->findAll();
        }
    }

    /**
     * @inheritdoc
     */
    public function find(int $id): ?Product
    {
        // TODO: Implement find() method.
        if (true /* sth */) {
            return $this->nextRepository->find($id);
        }
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
<?php
declare(strict_types=1);

namespace Infrastructure\Repository;


use Infrastructure\DataStorage\DataStorageInterface;
use Model\Product;
use Repository\ProductRepositoryInterface;
use Repository\RepositoryInterface;

class ElasticProductRepository implements ProductRepositoryInterface
{
    use ChainedProductRepositoryTrait;

    /**
     * @var DataStorageInterface
     */
    private $storage;

    /**
     * ElasticProductRepository constructor.
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
        $ids = $this->getAllProductIds();
        $products = [];

        // get ids from real repo and one by one check cache and add cache if necessary
        foreach ($ids as $id) {
            $products[$id] = $this->buildProduct($id);
        }

        return $products;
    }

    /**
     * @inheritdoc
     */
    public function find(int $id): ?Product
    {
        return $this->buildProduct($id);
    }

    /**
     * @param Product $product
     */
    public function increaseViewCount(Product $product): void
    {
        $this->nextRepository->increaseViewCount($product);
    }

    /**
     * @param int $id
     *
     * @return Product|null
     */
    private function getCachedProduct(int $id): ?Product
    {
        $data = $this->storage->executeQuery("...");

        // ..

        return $data ? new Product() : null;
    }

    /**
     * @param $id
     *
     * @return Product
     */
    private function buildProduct($id): Product
    {
        $cached = $this->getCachedProduct($id);
        if ($cached instanceof Product && $this->isCacheValid($id)) {
            $product = $cached;
        } else {
            $product = $this->nextRepository->find($id);
            $this->cacheProduct($product);
        }

        return $product;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    private function isCacheValid($id): bool
    {
        // check when product was cached
        $this->storage->executeQuery("...");
        return true;
    }

    /**
     * @param Product $product
     */
    private function cacheProduct(Product $product): void
    {
        // index product in cache repository
        $this->storage->executeQuery("...");
    }

    /**
     * @return array
     */
    public function getAllProductIds(): array
    {
        // forward to next repo
        return $this->nextRepository->getAllProductIds();
    }
}
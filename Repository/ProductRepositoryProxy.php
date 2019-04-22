<?php
declare(strict_types=1);

namespace Repository;


use DataStorage\DataStorageInterface;
use Model\Product;

class ProductRepositoryProxy implements ProductRepositoryInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var DataStorageInterface
     */
    private $cacheStorage;

    /**
     * ProductRepositoryProxy constructor.
     *
     * @param ProductRepository    $productRepository
     * @param DataStorageInterface $cacheStorage
     */
    public function __construct(ProductRepository $productRepository, DataStorageInterface $cacheStorage)
    {
        $this->productRepository = $productRepository;
        $this->cacheStorage      = $cacheStorage;
    }

    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        $ids = $this->productRepository->getAllProductIds();
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
        $this->productRepository->increaseViewCount($product);
    }

    /**
     * @param int $id
     *
     * @return Product|null
     */
    private function getCachedProduct(int $id): ?Product
    {
        $data = $this->cacheStorage->executeQuery("...");

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
            $product = $this->productRepository->find($id);
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
        $this->cacheStorage->executeQuery("...");
        return true;
    }

    /**
     * @param Product $product
     */
    private function cacheProduct(Product $product): void
    {
        // index product in cache repository
        $this->cacheStorage->executeQuery("...");
    }
}
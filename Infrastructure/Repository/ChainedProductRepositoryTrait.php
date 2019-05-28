<?php
declare(strict_types=1);

namespace Infrastructure\Repository;

use Repository\ProductRepositoryInterface;

trait ChainedProductRepositoryTrait
{
    /** @var ProductRepositoryInterface */
    protected $nextRepository;

    /**
     * @return ProductRepositoryInterface
     */
    public function getNextRepository(): ProductRepositoryInterface
    {
        return $this->nextRepository;
    }
}
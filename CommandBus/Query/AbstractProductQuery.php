<?php
declare(strict_types=1);

namespace CommandBus\Query;


use Repository\ProductRepositoryInterface;

abstract class AbstractProductQuery implements QueryInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * AbstractProductQuery constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;}
}

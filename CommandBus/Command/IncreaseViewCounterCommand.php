<?php
declare(strict_types=1);

namespace CommandBus\Command;

use Model\Product;

final class IncreaseViewCounterCommand
{
    /**
     * @var Product
     */
    private $product;

    /**
     * IncreaseViewCounterCommand constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}
<?php
declare(strict_types=1);

namespace Event\Event;

use Model\Product;

final class ProductDetailsReadEvent
{
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductDetailsReadEvent constructor.
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
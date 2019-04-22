<?php
declare(strict_types=1);

namespace CommandBus\Query;

use Model\Product;

final class GetProductsListQuery extends AbstractProductQuery
{
    /**
     * @return array|Product[]
     */
    public function execute(): array
    {
        return $this->productRepository->findAll();
    }
}
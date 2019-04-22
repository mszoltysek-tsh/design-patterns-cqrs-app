<?php
declare(strict_types=1);

namespace CommandBus\Query;

use App\ViewModel\ProductView;
use Model\Product;

final class GetProductsListQuery extends AbstractProductQuery
{
    /**
     * @return array|ProductView[]
     */
    public function execute(): array
    {
        $products = $this->productRepository->findAll();

        return array_map(function (Product $product) {
            return new ProductView(
                $product->getId(),
                $product->getTitle()
            );
        }, $products);
    }
}
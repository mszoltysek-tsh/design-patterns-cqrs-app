<?php
declare(strict_types=1);

namespace App\Controller;

use CommandBus\Query\GetProductQuery;
use CommandBus\Query\GetProductsListQuery;

class ProductController extends AbstractController
{
    public function getListAction()
    {
        /** @var GetProductsListQuery $query */
        $query = $this->container->getQueryRegistry()->getQuery(GetProductsListQuery::class);

        $products = $query->execute();

        return $products;
    }

    public function getAction(int $productId)
    {
        /** @var GetProductQuery $query */
        $query = $this->container->getQueryRegistry()->getQuery(GetProductQuery::class);
        $query->setProductId($productId);

        $product = $query->execute();

        return $product;
    }
}
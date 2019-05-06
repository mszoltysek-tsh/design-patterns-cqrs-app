<?php
declare(strict_types=1);

namespace Controller;


use App\ViewModel\ProductDetailsView;
use CommandBus\Query\GetProductQuery;

class GetProductAction
{
    /**
     * @var GetProductQuery
     */
    private $query;

    /**
     * GetProductAction constructor.
     *
     * @param GetProductQuery $query
     */
    public function __construct(GetProductQuery $query)
    {
        $this->query = $query;
    }

    /**
     * @param int $productId
     *
     * @return ProductDetailsView|null
     */
    public function __invoke(int $productId)
    {
        return $this->getProductAction($productId);
    }

    /**
     * @param int $productId
     *
     * @return ProductDetailsView|null
     */
    private function getProductAction(int $productId)
    {
        $this->query->setProductId($productId);

        $product = $this->query->execute();

        // @TODO serialization

        return $product;
    }

}
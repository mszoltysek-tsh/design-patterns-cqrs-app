<?php
declare(strict_types=1);

namespace Controller;


use App\ViewModel\ProductView;
use CommandBus\Query\GetProductsListQuery;

class GetProductListAction
{
    /**
     * @var GetProductsListQuery
     */
    private $query;

    /**
     * GetProductListAction constructor.
     *
     * @param GetProductsListQuery $query
     */
    public function __construct(GetProductsListQuery $query)
    {
        $this->query = $query;
    }

    /**
     * @return ProductView[]|array
     */
    public function __invoke()
    {
        return $this->getProductListAction();
    }

    /**
     * @return ProductView[]|array
     */
    private function getProductListAction()
    {
        $products = $this->query->execute();

        // @TODO serialization

        return $products;
    }

}
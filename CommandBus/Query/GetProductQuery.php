<?php
declare(strict_types=1);

namespace CommandBus\Query;

use App\Event\EventDispatcherInterface;
use App\ViewModel\ProductDetailsView;
use Event\Event\ProductDetailsReadEvent;
use Repository\ProductRepositoryInterface;

final class GetProductQuery extends AbstractProductQuery
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var int
     */
    private $productId;

    /**
     * GetProductQuery constructor.
     *
     * @param EventDispatcherInterface   $eventDispatcher
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, ProductRepositoryInterface $productRepository)
    {
        $this->eventDispatcher = $eventDispatcher;
        parent::__construct($productRepository);
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return ProductDetailsView|null
     */
    public function execute(): ?ProductDetailsView
    {
        $product = $this->productRepository->find($this->productId);

        $this->eventDispatcher->handleEvent(new ProductDetailsReadEvent($product));

        return $product ? new ProductDetailsView(
            $product->getId(),
            $product->getTitle(),
            $product->getDescription(),
            $product->getSku(),
            $product->getViewsCounter()
        ) : null;
    }
}

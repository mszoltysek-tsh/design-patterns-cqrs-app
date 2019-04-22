<?php
declare(strict_types=1);

namespace CommandBus\Handler;

use CommandBus\Command\IncreaseViewCounterCommand;
use Repository\ProductRepositoryInterface;

final class IncreaseViewCounterHandler implements HandlerInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * IncreaseViewCounterHandler constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param IncreaseViewCounterCommand $command
     */
    public function handle($command): void
    {
        $this->productRepository->increaseViewCount($command->getProduct());
    }
}
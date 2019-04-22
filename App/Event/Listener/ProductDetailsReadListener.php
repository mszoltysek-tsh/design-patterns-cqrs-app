<?php
declare(strict_types=1);

namespace Event\Listener;

use App\Event\Listener\ListenerInterface;
use CommandBus\Command\IncreaseViewCounterCommand;
use CommandBus\CommandBusInterface;
use Event\Event\ProductDetailsReadEvent;

class ProductDetailsReadListener implements ListenerInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * ProductDetailsReadListener constructor.
     *
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param ProductDetailsReadEvent $event
     */
    public function handleEvent($event): void
    {
        $product = $event->getProduct();

        $command = new IncreaseViewCounterCommand($product);
        $this->commandBus->getHandler(IncreaseViewCounterCommand::class)->handle($command);
    }
}
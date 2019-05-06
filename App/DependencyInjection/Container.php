<?php
declare(strict_types=1);

namespace App\DependencyInjection;

use App\Event\EventDispatcher;
use App\Event\EventDispatcherInterface;
use CommandBus\Command\IncreaseViewCounterCommand;
use CommandBus\CommandBus;
use CommandBus\CommandBusInterface;
use CommandBus\Handler\IncreaseViewCounterHandler;
use Event\Event\ProductDetailsReadEvent;
use Event\Listener\ProductDetailsReadListener;
use Model\Product;

class Container
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var QueryRegistry
     */
    private $queryRegistry;

    /**
     * @var RepositoryRegistry
     */
    private $repositoryRegistry;

    /**
     * Container constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Container
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setup()
    {
        // build repositories
        $this->repositoryRegistry = RepositoryRegistry::getInstance();
        $this->repositoryRegistry->setup();

        // build command bus
        $this->commandBus = CommandBus::getInstance();
        $this->commandBus->registerHandler(IncreaseViewCounterCommand::class, new IncreaseViewCounterHandler(
            $this->repositoryRegistry->getRepository(Product::class)
        ));

        // build event dispatcher
        $this->eventDispatcher = EventDispatcher::getInstance();
        $this->eventDispatcher->addListener(ProductDetailsReadEvent::class, new ProductDetailsReadListener(
            $this->commandBus
        ));

        // build query registry
        $this->queryRegistry = QueryRegistry::getInstance();
        $this->queryRegistry->setEventDispatcher($this->eventDispatcher);
        $this->queryRegistry->setRepositoryRegistry($this->repositoryRegistry);
        $this->queryRegistry->setup();

        // build controllers
        // TODO setup action classes and inject required dependencies
    }

    /**
     * @return CommandBusInterface
     */
    public function getCommandBus(): CommandBusInterface
    {
        return $this->commandBus;
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

    /**
     * @return QueryRegistry
     */
    public function getQueryRegistry(): QueryRegistry
    {
        return $this->queryRegistry;
    }

    /**
     * @return RepositoryRegistry
     */
    public function getRepositoryRegistry(): RepositoryRegistry
    {
        return $this->repositoryRegistry;
    }
}
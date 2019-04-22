<?php
declare(strict_types=1);

namespace App\DependencyInjection;

use App\Event\EventDispatcherInterface;
use CommandBus\Query\GetProductQuery;
use CommandBus\Query\GetProductsListQuery;
use CommandBus\Query\QueryInterface;
use Model\Product;

class QueryRegistry
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var array|QueryInterface[]
     */
    private $queryRegistry;

    /** @var RepositoryRegistry */
    private $repositoryRegistry;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * QueryRegistry constructor.
     */
    private function __construct()
    {
        $this->queryRegistry = [];
    }

    /**
     * @return QueryRegistry
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param RepositoryRegistry $repositoryRegistry
     *
     * @return QueryRegistry
     */
    public function setRepositoryRegistry(RepositoryRegistry $repositoryRegistry): QueryRegistry
    {
        $this->repositoryRegistry = $repositoryRegistry;
        return $this;
    }

    /**
     * @param EventDispatcherInterface $eventDispatcher
     *
     * @return QueryRegistry
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): QueryRegistry
    {
        $this->eventDispatcher = $eventDispatcher;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function setup(): void
    {
        // build list query
        $this->queryRegistry[GetProductsListQuery::class] = new GetProductsListQuery(
            $this->repositoryRegistry->getRepository(Product::class)
        );

        // build list query
        $this->queryRegistry[GetProductQuery::class] = new GetProductQuery(
            $this->eventDispatcher,
            $this->repositoryRegistry->getRepository(Product::class)
        );
    }

    /**
     * @param string $queryName
     *
     * @return QueryInterface|null
     */
    public function getQuery(string $queryName): ?QueryInterface
    {
        return array_key_exists($queryName, $this->queryRegistry) ? $this->queryRegistry[$queryName] : null;
    }
}
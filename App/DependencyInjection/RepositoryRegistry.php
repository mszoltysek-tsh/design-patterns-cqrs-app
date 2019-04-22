<?php
declare(strict_types=1);

namespace App\DependencyInjection;

use DataStorage\ElasticStorage;
use DataStorage\MysqlStorage;
use Model\Product;
use Repository\ProductRepository;
use Repository\ProductRepositoryProxy;
use Repository\RepositoryInterface;

class RepositoryRegistry
{
    /**
     * @var self
     */
    private static $instance;

    /** @var array|RepositoryInterface[] */
    private $repositories;

    /**
     * RepositoryRegistry constructor.
     */
    private function __construct()
    {
        $this->repositories = [];
        $this->setup();
    }

    /**
     * @return RepositoryRegistry
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
        $this->repositories = [];
        $this->repositories[Product::class] = new ProductRepositoryProxy(
            new ProductRepository(
                new MysqlStorage()
            ),
            new ElasticStorage()
        );
    }

   /**
     * @param string $modelName
     *
     * @return RepositoryInterface
     * @throws \Exception
     */
    public function getRepository(string $modelName): RepositoryInterface
    {
        if (!array_key_exists($modelName, $this->repositories)) {
            throw new \Exception('Missing repository for model: '.$modelName);
        }

        return $this->repositories[$modelName];
    }
}
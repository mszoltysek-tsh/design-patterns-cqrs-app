<?php
declare(strict_types=1);

namespace App\Controller;

use App\DependencyInjection\Container;

abstract class AbstractController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
<?php
declare(strict_types=1);

namespace CommandBus\Query;


interface QueryInterface
{
    /**
     * @return mixed
     */
    public function execute();
}
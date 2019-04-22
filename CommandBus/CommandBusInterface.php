<?php
declare(strict_types=1);

namespace CommandBus;

use CommandBus\Handler\HandlerInterface;

interface CommandBusInterface
{
    /**
     * @param string           $commandName
     * @param HandlerInterface $handler
     */
    public function registerHandler(string $commandName, HandlerInterface $handler): void;

    /**
     * @param string $commandName
     *
     * @return HandlerInterface|null
     */
    public function getHandler(string $commandName): ?HandlerInterface;
}
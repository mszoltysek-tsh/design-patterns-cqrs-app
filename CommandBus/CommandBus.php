<?php
declare(strict_types=1);

namespace CommandBus;

use CommandBus\Handler\HandlerInterface;

class CommandBus implements CommandBusInterface
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var array|HandlerInterface[]
     */
    private $handlerRegistry;

    /**
     * CommandBus constructor.
     */
    private function __construct()
    {
        $this->handlerRegistry = [];
    }

    /**
     * @return CommandBus
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new CommandBus();
        }

        return self::$instance;
    }

    /**
     * @param string           $commandName
     * @param HandlerInterface $handler
     */
    public function registerHandler(string $commandName, HandlerInterface $handler): void
    {
        $this->handlerRegistry[$commandName] = $handler;
    }

    /**
     * @param string $commandName
     *
     * @return HandlerInterface|null
     */
    public function getHandler(string $commandName): ?HandlerInterface
    {
        return array_key_exists($commandName, $this->handlerRegistry) ? $this->handlerRegistry[$commandName] : null;
    }
}
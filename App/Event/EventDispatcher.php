<?php
declare(strict_types=1);

namespace App\Event;

use App\Event\Listener\ListenerInterface;

class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var array|ListenerInterface[]
     */
    private $listenerRegistry;

    /**
     * EventDispatcher constructor.
     */
    private function __construct()
    {
        $this->listenerRegistry = [];
    }

    /**
     * @return EventDispatcher
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new EventDispatcher();
        }

        return self::$instance;
    }

    /**
     * @inheritdoc
     */
    public function addListener($eventName, ListenerInterface $listener): void
    {
        if (!array_key_exists($eventName, $this->listenerRegistry)) {
            $this->listenerRegistry[$eventName] = [];
        }

        $this->listenerRegistry[$eventName][] = $listener;
    }

    /**
     * @inheritdoc
     */
    public function handleEvent($event): void
    {
        $eventName = get_class($event);

        if (!array_key_exists($eventName, $this->listenerRegistry)) {
            return;
        }

        /** @var ListenerInterface $listener */
        foreach ($this->listenerRegistry[$eventName] as $listener) {
            $listener->handleEvent($event);
        }
    }
}
<?php
declare(strict_types=1);

namespace App\Event;

use App\Event\Listener\ListenerInterface;

interface EventDispatcherInterface
{
    /**
     * Registers listener for event
     * @param                   $eventName
     * @param ListenerInterface $listener
     */
    public function addListener($eventName, ListenerInterface $listener): void;

    /**
     * Handles event
     * 
     * @param $event
     */
    public function handleEvent($event): void;
}
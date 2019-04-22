<?php
declare(strict_types=1);

namespace App\Event\Listener;


interface ListenerInterface
{
    public function handleEvent($event): void;
}
<?php
declare(strict_types=1);


namespace CommandBus\Handler;


interface HandlerInterface
{
    public function handle($command): void;
}
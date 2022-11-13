<?php

namespace CaioMarcatti12\Event\Interfaces;

use Closure;

interface EventManagerInterface
{
    public function subscribe(string $name, Closure $callback): void;
    public function publish(string $name, mixed $payload = null): void;
    public function unsubscribe(string $name): void;
    public function dispatch(): void;
    public function clearPayload(): void;
}
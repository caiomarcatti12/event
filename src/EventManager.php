<?php

namespace CaioMarcatti12\Event;

use CaioMarcatti12\Core\Factory\Annotation\Autowired;
use Closure;
use CaioMarcatti12\Event\Interfaces\EventManagerInterface;

class EventManager implements EventManagerInterface
{
    #[Autowired]
    private EventManagerInterface $eventManager;

    public function subscribe(string $name, Closure $callback): void
    {
        $this->eventManager->subscribe($name, $callback);
    }

    public function publish(string $name, mixed $payload = null): void
    {
        $this->eventManager->publish($name, $payload);
    }

    public function unsubscribe(string $name): void
    {
        $this->eventManager->unsubscribe($name);
    }

    public function dispatch(): void
    {
        $this->eventManager->dispatch();
    }

    public function clearPayload(): void
    {
        $this->eventManager->clearPayload();
    }
}
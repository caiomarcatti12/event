<?php

namespace CaioMarcatti12\Event\Adapter;

use Closure;
use CaioMarcatti12\Event\Interfaces\EventManagerInterface;

class EventManagerMemoryAdapter implements EventManagerInterface
{
    private array $events = [];
    private array $eventsPayload = [];

    public function subscribe(string $name, Closure $callback): void
    {
        if (empty($this->events[$name]))
            $this->events[$name] = [];

        $this->events[$name][] = $callback;
    }

    public function publish(string $name, mixed $payload = null): void
    {
        if (!isset($this->eventsPayload[$name])) $this->eventsPayload[$name] = [];

        $this->eventsPayload[$name][] = $payload;
    }

    public function unsubscribe(string $name) : void
    {
        if (!empty($this->events[$name]))
            unset($this->events[$name]);
    }

    public function dispatch(): void
    {
        foreach ($this->events as $name => $event)
        {
            foreach($event as $callback){
                if (is_callable($callback) && isset($this->eventsPayload[$name])){
                    foreach($this->eventsPayload[$name] as $payload){
                        @call_user_func($callback, $payload);
                    }
                }
            }
        }

        $this->clearPayload();
    }

    public function clearPayload(): void
    {
        $this->eventsPayload = [];
    }
}
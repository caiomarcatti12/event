<?php

namespace CaioMarcatti12\Event\Interfaces;

interface EventInterface
{
    public function handler(mixed $payload): void;
}
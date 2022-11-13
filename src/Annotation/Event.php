<?php

namespace CaioMarcatti12\Event\Annotation;

use Attribute;
use CaioMarcatti12\Core\Bean\Exception\BadConstructAnnotationResolverException;
use CaioMarcatti12\Core\Validation\Assert;

#[Attribute(Attribute::TARGET_CLASS)]
class Event
{
    private string $event = '';

    public function __construct(string $event)
    {
        if(Assert::isEmpty($event)) throw new BadConstructAnnotationResolverException();

        $this->event = $event;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }
}
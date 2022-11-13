<?php

namespace CaioMarcatti12\Event\Annotation;

use Attribute;
use CaioMarcatti12\Core\Modules\Modules;
use CaioMarcatti12\Core\Modules\ModulesEnum;
use CaioMarcatti12\Event\Adapter\EventManagerMemoryAdapter;

#[Attribute(Attribute::TARGET_CLASS)]
class EnableEvent
{
    private string $adapter = '';

    public function __construct(string $adapter = EventManagerMemoryAdapter::class)
    {
        $this->adapter = $adapter;

        Modules::enable(ModulesEnum::EVENT);
    }

    public function getAdapter(): string
    {
        return $this->adapter;
    }
}
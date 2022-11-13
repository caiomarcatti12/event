<?php

namespace CaioMarcatti12\Event\Resolver;

use CaioMarcatti12\Core\Bean\Annotation\AnnotationResolver;
use CaioMarcatti12\Core\Bean\Interfaces\ClassResolverInterface;
use CaioMarcatti12\Core\Bean\Objects\BeanProxy;
use CaioMarcatti12\Core\Factory\InstanceFactory;
use ReflectionClass;
use CaioMarcatti12\Event\Annotation\EnableEvent;
use CaioMarcatti12\Event\Interfaces\EventManagerInterface;
use CaioMarcatti12\Event\EventLoader;

#[AnnotationResolver(EnableEvent::class)]
class EnableEventResolver implements ClassResolverInterface
{
    public function handler(object &$instance): void
    {
        $reflectionClass = new ReflectionClass($instance);

        $attributes = $reflectionClass->getAttributes(EnableEvent::class);

        /** @var EnableEvent $attribute */
        $attribute = ($attributes[0]->newInstance());

        BeanProxy::add(EventManagerInterface::class, $attribute->getAdapter());
    }
}
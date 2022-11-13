<?php

namespace CaioMarcatti12\Event;

use CaioMarcatti12\Core\ExtractPhpNamespace;
use CaioMarcatti12\Core\Factory\Annotation\Autowired;
use CaioMarcatti12\Core\Factory\InstanceFactory;
use CaioMarcatti12\Core\Launcher\Annotation\Launcher;
use CaioMarcatti12\Core\Launcher\Enum\LauncherPriorityEnum;
use CaioMarcatti12\Core\Modules\Modules;
use CaioMarcatti12\Core\Modules\ModulesEnum;
use CaioMarcatti12\Core\Validation\Assert;
use CaioMarcatti12\Event\Annotation\Event;
use CaioMarcatti12\Event\Interfaces\EventManagerInterface;

#[Launcher(LauncherPriorityEnum::BEFORE_LOAD_APPLICATION)]
class EventLoader
{
    #[Autowired]
    private EventManagerInterface $eventManager;

    public function handler(): void
    {
        $filesApplication = ExtractPhpNamespace::getFilesApplication();
        $filesFramework = ExtractPhpNamespace::getFilesFramework();

        $this->parseEvents(array_merge($filesApplication, $filesFramework));
    }

    private function parseEvents(array $files): void {
        foreach($files as $file){
            $reflectionClass = new \ReflectionClass($file);

            $reflectionAttributes = $reflectionClass->getAttributes(Event::class);

            if(Assert::isNotEmpty($reflectionAttributes)){
                $instance = InstanceFactory::createIfNotExists($reflectionClass->getName());

                /** @var \ReflectionAttribute $attribute */
                $attribute = array_shift($reflectionAttributes);

                /** @var Event $event */
                $event = $attribute->newInstance();

                $this->eventManager->subscribe($event->getEvent(), function(mixed $payload) use ($instance){
                    $instance->handler($payload);
                });
            }
        }
    }
}

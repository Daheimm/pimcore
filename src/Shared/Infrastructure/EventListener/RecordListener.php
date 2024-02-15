<?php

namespace App\Shared\Infrastructure\EventListener;

use App\Shared\Application\Factories\DataProcessingLayersInterfaces;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Event\Model\ElementEventInterface;
use Psr\Log\LoggerInterface;

class RecordListener
{
    public function __construct(
        private readonly DataProcessingLayersInterfaces $dataProcessingLayersInterfaces,
        private readonly LoggerInterface                $logger)
    {
    }

    public function onPostUpdate(ElementEventInterface $event): void
    {
        try {
            if ($event instanceof DataObjectEvent) {
                $this->dataProcessingLayersInterfaces->createHandler($event->getObject()::class, $event->getObject());
            }
        } catch (Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}

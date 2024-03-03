<?php

namespace App\Shared\Infrastructure\EventListener;

use App\Shared\Application\Factories\DataProcessingLayersInterfaces;
use Exception;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Event\Model\ElementEventInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: 'pimcore.dataobject.postDelete', method: 'onDeleteDataObject')]
class RecordDeleteListener
{
    public function __construct(
        private readonly DataProcessingLayersInterfaces $dataProcessingLayersInterfaces,
        private readonly LoggerInterface $logger)
    {
    }

    public function onDeleteDataObject(ElementEventInterface $event): void
    {
        try {
            if ($event instanceof DataObjectEvent) {
                $this->dataProcessingLayersInterfaces->createHandler($event->getObject()::class, $event->getObject(), 'postDelete');
            }
        } catch (Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}

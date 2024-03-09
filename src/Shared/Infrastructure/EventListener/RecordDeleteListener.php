<?php

namespace App\Shared\Infrastructure\EventListener;

use Exception;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Event\Model\ElementEventInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: 'pimcore.dataobject.postDelete', method: 'onDeleteDataObject')]
class RecordDeleteListener
{
    public function __construct(
        private readonly LoggerInterface $logger)
    {
    }

    public function onDeleteDataObject(ElementEventInterface $event): void
    {
        try {
            if ($event instanceof DataObjectEvent) {
            }
        } catch (Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}

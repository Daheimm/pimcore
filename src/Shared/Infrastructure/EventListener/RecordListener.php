<?php

namespace App\Shared\Infrastructure\EventListener;

use App\Shared\Application\Facades\RabbitMQ\RabbitMQFacade;
use App\Shared\Application\RabbitMQ\Messages\ObjectData\ObjectDataMessage;
use Exception;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Event\Model\ElementEventInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;

class RecordListener
{
    public function __construct(
        private readonly LoggerInterface $logger)
    {
    }

    public function onPostUpdate(ElementEventInterface $event): void
    {
        try {
            if ($event instanceof DataObjectEvent) {
                RabbitMQFacade::dispatch(new ObjectDataMessage('update',
                    $event->getObject()::class,
                    $event->getObject()->getPath(),
                    $event->getObject()->getId(),
                    $event->getObject()->getClassId(),
                ),
                    [
                        new AmqpStamp(ObjectDataMessage::ROUTE_MESSAGE),
                    ]
                );
            }
        } catch (Exception $e) {
            dd($e);
            $this->logger->critical($e->getMessage());
        }
    }
}

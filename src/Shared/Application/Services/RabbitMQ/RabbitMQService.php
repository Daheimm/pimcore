<?php

namespace App\Shared\Application\Services\RabbitMQ;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;


readonly class RabbitMQService
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    /**
     * @param object $object
     * @param array $options
     * @return Envelope
     */
    public function dispatch(object $object, array $options): Envelope
    {
        return $this->bus->dispatch($object, $options);
    }
}

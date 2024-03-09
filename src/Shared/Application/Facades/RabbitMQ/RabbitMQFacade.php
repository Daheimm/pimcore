<?php

namespace App\Shared\Application\Facades\RabbitMQ;

use App\Shared\Application\Services\RabbitMQ\RabbitMQService;
use Lagdo\Symfony\Facades\AbstractFacade;
use Symfony\Component\Messenger\Envelope;

/**
 * @method static Envelope dispatch(object $object, array $options)
 */
class RabbitMQFacade extends AbstractFacade
{
    /**
     *
     * @inheritDoc
     * @return string
     */
    protected static function getServiceIdentifier(): string
    {
        return RabbitMQService::class;
    }
}

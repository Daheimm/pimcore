<?php

namespace App\Shared\Application\Facades\RabbitMQ;

use App\Shared\Application\Services\RabbitMQ\RabbitMQService;
use Lagdo\Symfony\Facades\AbstractFacade;

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

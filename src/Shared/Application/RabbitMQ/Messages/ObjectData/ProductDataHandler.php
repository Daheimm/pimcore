<?php

namespace App\Shared\Application\RabbitMQ\Messages\ObjectData;


use App\PimCore\ProductInfo\Products\Infrastructure\Facades\ProductHandlerFacade;
use Pimcore\Model\DataObject\Product;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ProductDataHandler
{
    public function __invoke(ObjectDataMessage $objectDataMessage): void
    {
        match ($objectDataMessage->getClass()) {
            Product::class => ProductHandlerFacade::handler($objectDataMessage->getClass(), $objectDataMessage->getId(), $objectDataMessage->getClassDefinitionId()),
            default => '',
        };
    }
}

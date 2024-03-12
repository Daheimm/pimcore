<?php

namespace App\Shared\Application\RabbitMQ\Messages\ObjectData;


use App\PimCore\ProductInfo\Products\Infrastructure\Facades\ProductHandlerFacade;
use App\Shared\Application\Dto\ObjectDatas\ObjectDataDto;
use Pimcore\Model\DataObject\Product;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ProductDataHandler
{
    public function __invoke(ObjectDataMessage $objectDataMessage): void
    {

        $dto = (new ObjectDataDto())
            ->setId($objectDataMessage->getId())
            ->setPathFolder($objectDataMessage->getPathFolder())
            ->setMethod($objectDataMessage->getMethod())
            ->setClassDefinitionId($objectDataMessage->getClassDefinitionId())
            ->setMethod($objectDataMessage->getMethod())
            ->setClass($objectDataMessage->getClass());
        match ($objectDataMessage->getClass()) {
            Product::class => ProductHandlerFacade::handler($dto),
            default => '',
        };
    }
}

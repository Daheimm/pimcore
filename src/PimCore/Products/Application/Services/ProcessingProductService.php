<?php

namespace App\PimCore\Products\Application\Services;


use App\PimCore\Products\Application\Services\Interfaces\DataTransformationServiceInterface;
use App\PimCore\Products\Application\Services\Interfaces\ProcessingProductServiceInterface;
use App\PimCore\Products\Application\Messages\ProductCreateMessage;
use Pimcore\Model\DataObject\Product;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;


class ProcessingProductService implements ProcessingProductServiceInterface
{
    public function __construct(
        private readonly DataTransformationServiceInterface $dataTransformationService,
        private readonly MessageBusInterface                $bus
    )
    {
    }

    public function processingUpdate(?Product $object)
    {
        $products = $this->dataTransformationService->prepare($object);

        $this->bus->dispatch(new ProductCreateMessage($products), [
            new AmqpStamp(ProductCreateMessage::ROUTING_KEY),
        ]);
    }
}

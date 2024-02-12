<?php

namespace App\PimCore\Products\Application\Services;


use App\PimCore\Products\Application\Services\Interfaces\DataTransformationServiceInterface;
use App\PimCore\Products\Application\Services\Interfaces\ProcessingProductServiceInterface;
use App\PimCore\Products\Application\Messages\ProductCreateMessage;
use App\PimCore\Products\Application\Services\Interfaces\ProductsInformation\ProductInfoProcessorServiceInterface;
use Pimcore\Model\DataObject\Product;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;


class ProcessingProductService implements ProcessingProductServiceInterface
{
    public function __construct(
        private readonly ProductInfoProcessorServiceInterface $infoProcessorService,
        private readonly MessageBusInterface                  $bus
    )
    {
    }

    public function processingUpdate(?Product $object)
    {
        $res = $this->infoProcessorService->extract([$object]);

        $this->bus->dispatch(new ProductCreateMessage($res), [
            new AmqpStamp(ProductCreateMessage::ROUTING_KEY),
        ]);
    }
}

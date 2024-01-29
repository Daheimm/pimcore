<?php

namespace App\Shared\Application\Factories;

use App\PimCore\Products\Application\Services\Interfaces\ProcessingProductServiceInterface;
use App\Shared\Application\Serivces\ServicesInterfaces;
use Pimcore\Model\DataObject\Product;

final class DataProcessingLayers implements DataProcessingLayersInterfaces
{
    public function __construct(private readonly ProcessingProductServiceInterface $productProcessing)
    {
    }

    public function createHandler(string $type, object $object): void
    {
        match ($type) {
            Product::class => $this->productProcessing->processingUpdate($object),
            default => []
        };
    }
}

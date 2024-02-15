<?php

namespace App\Shared\Application\Factories;

use App\PimCore\Products\Application\Services\Interfaces\ProcessingProductServiceInterface;
use App\PimCore\Receipts\Application\Services\Interfaces\RecipeProcessingServiceInterface;
use App\Shared\Application\Serivces\ServicesInterfaces;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\DataObject\Recipe;

final class DataProcessingLayers implements DataProcessingLayersInterfaces
{
    public function __construct(
        private readonly RecipeProcessingServiceInterface $recipeProcessingService,)
    {
    }

    public function createHandler(string $type, object $object): void
    {
        match ($type) {
            //Product::class => $this->productProcessing->processingUpdate($object),
            Recipe::class => $this->recipeProcessingService->processingUpdate($object),
            default => []
        };
    }
}

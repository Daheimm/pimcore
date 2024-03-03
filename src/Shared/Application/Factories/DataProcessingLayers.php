<?php

namespace App\Shared\Application\Factories;

use App\PimCore\Receipts\Application\Services\Interfaces\RecipeProcessingServiceInterface;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\DataObject\Recipe;

final class DataProcessingLayers implements DataProcessingLayersInterfaces
{
    public function __construct(
        private readonly RecipeProcessingServiceInterface $recipeProcessingService, )
    {
    }

    public function createHandler(string $type, object $object, string $eventName): void
    {
        match ($type) {
            //Product::class => $this->productProcessing->processingUpdate($object),
            Recipe::class => $this->recipeProcessingService->processing($object, $eventName),
            default => []
        };
    }
}

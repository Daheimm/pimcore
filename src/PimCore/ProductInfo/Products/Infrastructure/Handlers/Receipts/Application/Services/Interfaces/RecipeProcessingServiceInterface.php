<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\Handlers\Receipts\Application\Services\Interfaces;

use Pimcore\Model\DataObject\Recipe;

interface RecipeProcessingServiceInterface
{
    public function processing(Recipe $recipe, string $eventName): void;
}

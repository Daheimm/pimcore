<?php

namespace App\PimCore\Receipts\Application\Services;

use App\PimCore\Receipts\Application\Services\Interfaces\EventUpdateRecipeServiceInterface;
use App\PimCore\Receipts\Application\Services\Interfaces\RecipeProcessingServiceInterface;
use Pimcore\Model\DataObject\Recipe;

class RecipeProcessingService implements RecipeProcessingServiceInterface
{

    public function __construct(private readonly EventUpdateRecipeServiceInterface $eventUpdateRecipeService)
    {
    }

    public function processing(Recipe $recipe, string $eventName): void
    {
        match ($eventName) {
            "postUpdate" => $this->eventUpdateRecipeService->update($recipe),
            "postDelete" =>  $this->eventUpdateRecipeService->delete($recipe),
            default => [],
        };

    }
}

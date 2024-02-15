<?php

namespace App\PimCore\Receipts\Application\Services\Interfaces;

use Pimcore\Model\DataObject\Recipe;

interface EventUpdateRecipeServiceInterface
{
    public function handler(Recipe $recipe): void;
}

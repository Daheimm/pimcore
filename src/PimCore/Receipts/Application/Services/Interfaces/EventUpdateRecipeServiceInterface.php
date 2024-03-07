<?php

namespace App\PimCore\Receipts\Application\Services\Interfaces;

use Pimcore\Model\DataObject\Recipe;

interface EventUpdateRecipeServiceInterface
{
    public function update(Recipe $recipe): void;

    public function delete(Recipe $recipe): void;
}

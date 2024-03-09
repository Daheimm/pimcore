<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\Handlers\Receipts\Application\Messages\GraphQl;

class RecipeInformationMessage
{
    const ROUTING_KEY = 'products.event.recipe.information';

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}

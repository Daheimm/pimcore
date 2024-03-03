<?php

namespace App\PimCore\Receipts\Application\Messages\GraphQl;

class RecipeDeleteMessage
{
    const ROUTING_KEY = 'products.event.recipe.delete';

    public function __construct(private readonly int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}

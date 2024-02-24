<?php

namespace App\PimCore\Receipts\Application\Messages\Exports;

class RecipeExportMessage
{
    const ROUTING_KEY = "products.recipe.exports.all";

    public function __construct(private array $data)
    {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }
}

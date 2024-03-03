<?php

namespace App\PimCore\Receipts\Application\Messages\GraphQl;

class RecipeUpdateMessage
{
    const ROUTING_KEY = 'products.event.recipe.update';

    public function __construct(private array $message)
    {
    }

    public function getMessage(): array
    {
        return $this->message;
    }

    public function setMessage(array $message): void
    {
        $this->message = $message;
    }
}

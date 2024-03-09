<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\Handlers\Receipts\Application\Services;

use App\PimCore\ProductInfo\Products\Infrastructure\Handlers\Receipts\Application\Messages\GraphQl\RecipeDeleteMessage;
use App\PimCore\ProductInfo\Products\Infrastructure\Handlers\Receipts\Application\Messages\GraphQl\RecipeInformationMessage;
use App\PimCore\ProductInfo\Products\Infrastructure\Handlers\Receipts\Application\Services\Interfaces\EventUpdateRecipeServiceInterface;
use Pimcore\Model\DataObject\Recipe;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class EventUpdateRecipeService implements EventUpdateRecipeServiceInterface
{
    public function __construct(
        private readonly MessageBusInterface $bus)
    {

    }

    public function update(Recipe $recipe): void
    {
        $this->bus->dispatch(new RecipeInformationMessage($recipe->getId()), [
            new AmqpStamp(RecipeInformationMessage::ROUTING_KEY),
        ]);
    }

    public function delete(Recipe $recipe): void
    {
        $this->bus->dispatch(new RecipeDeleteMessage($recipe->getId()), [
            new AmqpStamp(RecipeDeleteMessage::ROUTING_KEY),
        ]);
    }
}

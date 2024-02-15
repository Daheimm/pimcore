<?php

namespace App\PimCore\Receipts\Application\Services;

use App\PimCore\Receipts\Application\Messages\GraphQl\RecipeUpdateMessage;
use App\PimCore\Receipts\Application\Services\Interfaces\EventUpdateRecipeServiceInterface;
use App\Shared\Application\Serivces\GraphQl\Interfaces\GraphqlRequestsPimcoreServiceInterface;
use Pimcore\Model\DataObject\Recipe;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class EventUpdateRecipeService implements EventUpdateRecipeServiceInterface
{
    const TYPE = "Recipe";

    public function __construct(
        private readonly GraphqlRequestsPimcoreServiceInterface $graphqlRequestsPimcoreService,
        private readonly MessageBusInterface                    $bus)
    {

    }

    public function handler(Recipe $recipe): void
    {
        $graphQl = $this->graphqlRequestsPimcoreService->getGraphQl(self::TYPE);

        //$graphQl = $this->graphQL->executeQuery("pimcore-graphql-webservices/receipt", $graphQl->getQuery());

        $this->bus->dispatch(new RecipeUpdateMessage($recipe->getId(), $graphQl), [
            new AmqpStamp(RecipeUpdateMessage::ROUTING_KEY),
        ]);
    }
}

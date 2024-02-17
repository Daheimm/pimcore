<?php

namespace App\PimCore\Receipts\Infrastructure\MessageHandler;


use App\PimCore\Receipts\Application\Messages\GraphQl\RecipeInformationMessage;
use App\PimCore\Receipts\Application\Messages\GraphQl\RecipeUpdateMessage;
use App\Shared\Application\Serivces\GraphQl\Interfaces\GraphqlRequestsPimcoreServiceInterface;
use App\Shared\Application\Serivces\Http\GraphQL\GraphQLInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class RecipeMessageHandler
{
    const TYPE = "Recipe";

    public function __construct(
        private readonly GraphqlRequestsPimcoreServiceInterface $graphqlRequestsPimcoreService,
        private readonly GraphQLInterface                       $graphQL,
        private readonly MessageBusInterface                    $bus,
        private readonly LoggerInterface                        $logger
    )
    {
    }

    public function __invoke(RecipeInformationMessage $message): void
    {

        $graphQl = $this->graphqlRequestsPimcoreService->getGraphQl(self::TYPE);

        if (!$graphQl) {
            return;
        }
        $query = str_replace('$$id', $message->getId(), $graphQl->getQuery());

        $graphQl = $this->graphQL->executeQuery("pimcore-graphql-webservices/receipt", $query, $graphQl->getXApiKey());

        if (array_key_exists('errors', $graphQl)) {
            $this->logger->error($graphQl);
            return;
        }


        $this->bus->dispatch(new RecipeUpdateMessage($graphQl['data']),
            [
                new AmqpStamp(RecipeUpdateMessage::ROUTING_KEY),
            ]
        );
    }
}

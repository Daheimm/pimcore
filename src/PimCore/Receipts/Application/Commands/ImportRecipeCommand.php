<?php

namespace App\PimCore\Receipts\Application\Commands;

use App\PimCore\Receipts\Application\Messages\Exports\RecipeExportMessage;
use App\Shared\Application\Services\GraphQl\Interfaces\GraphqlRequestsPimcoreServiceInterface;
use App\Shared\Infrastructure\Http\GraphQL\GraphQLInterface;
use Pimcore\Console\AbstractCommand;
use Pimcore\Model\DataObject\Recipe;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:recipe-export',
    description: 'Product export'
)]
class ImportRecipeCommand extends AbstractCommand
{
    const TYPE = 'Recipe';

    public function __construct(

        private readonly GraphqlRequestsPimcoreServiceInterface $graphqlRequestsPimcoreService,
        private readonly GraphQLInterface $graphQL,
        private readonly MessageBusInterface $bus,
        private readonly LoggerInterface $logger
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $batchSize = 10;
        $offset = 0;
        $products = Recipe::getList();
        try {
            $graphQl = $this->graphqlRequestsPimcoreService->getGraphQl(self::TYPE);
            while (true) {
                $batchItems = $products?->getItems($offset, $batchSize);

                if (count($batchItems) === 0) {
                    break;
                }

                if (!$graphQl) {
                    return Command::FAILURE;
                }

                /**
                 * @var Recipe $recipe
                 */
                foreach ($batchItems as $recipe) {

                    $query = str_replace('$$id', $recipe->getId(), $graphQl->getQuery());

                    $graphQlResult = $this->graphQL->executeQuery('pimcore-graphql-webservices/receipt', $query, $graphQl->getXApiKey());

                    if (array_key_exists('errors', $graphQlResult)) {
                        $this->logger->error($graphQlResult);

                        return Command::FAILURE;
                    }

                    $this->bus->dispatch(new RecipeExportMessage($graphQlResult['data']), [
                        new AmqpStamp(RecipeExportMessage::ROUTING_KEY),
                    ]);
                }
                $offset += $batchSize;
            }
        } catch (\Exception $e) {
            $this->logger->error($e);
        }

        return Command::SUCCESS;
    }
}

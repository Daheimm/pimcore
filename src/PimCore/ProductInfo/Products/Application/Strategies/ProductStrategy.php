<?php

namespace App\PimCore\ProductInfo\Products\Application\Strategies;


use App\PimCore\Admin\SettingQueries\Application\Facades\PimCoreQueueSettingsFacade;
use App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
use App\Shared\Application\Facades\GraphQL\GraphQLFacade;
use App\Shared\Application\Facades\RabbitMQ\RabbitMQFacade;
use App\Shared\Infrastructure\Http\GraphQL\GraphQLInterface;

use Pimcore\Model\DataObject\Product;

class ProductStrategy implements ProcessingStrategyInterface
{
    public function __construct(
        private readonly GraphqlRequestsPimcoreRepositoryInterface $graphqlRequestsPimcoreRepository)
    {
    }

    public function process(int $id, int $classDefinitionId)
    {
        $requestCustom = PimCoreQueueSettingsFacade::getByTypeId($classDefinitionId);

        $requestCustom = GraphQLFacade::executeQuery(
            $requestCustom->getEndpoint(),
            $requestCustom->getQuery(),
            $requestCustom->getXApiKey()
        );

        //RabbitMQFacade::dispatch($requestCustom)
    }

    public function support(string $className)
    {
        return Product::class === $className;
    }
}

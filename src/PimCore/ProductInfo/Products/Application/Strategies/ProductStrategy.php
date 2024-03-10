<?php

namespace App\PimCore\ProductInfo\Products\Application\Strategies;


use App\PimCore\Admin\SettingQueries\Application\Facades\PimCoreQueueSettingsFacade;
use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl\FetchGraphqlRequestsPimcoreRepositoryInterface;
use App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
use App\PimCore\ProductInfo\Products\Application\Actions\Prepares\LoadDataToArrayAction;
use App\Shared\Application\Dto\ObjectDatas\ObjectDataDto;
use App\Shared\Application\Facades\GraphQL\GraphQLFacade;
use App\Shared\Application\Facades\RabbitMQ\RabbitMQFacade;
use App\Shared\Infrastructure\Http\GraphQL\GraphQLInterface;

use Pimcore\Model\DataObject\Product;

class ProductStrategy implements ProcessingStrategyInterface
{
    public function process(ObjectDataDto $objectDataDto)
    {
        $dataForQueue = [];
        $queriesGeneral = PimCoreQueueSettingsFacade::findByTypeIdWithEmptyEndpoint($objectDataDto->getClassDefinitionId());
        $queriesSpecific = PimCoreQueueSettingsFacade::findByTypeIdAndPath($objectDataDto->getClassDefinitionId(), $objectDataDto->getPathFolder());
dd($queriesSpecific);
        $dataForQueue[] = LoadDataToArrayAction::run($queriesGeneral);


        //RabbitMQFacade::dispatch($requestCustom)
    }

    public function support(string $className)
    {
        return Product::class === $className;
    }
}

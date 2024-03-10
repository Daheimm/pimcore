<?php

namespace App\PimCore\ProductInfo\Products\Application\Actions\Prepares;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\Shared\Application\Facades\GraphQL\GraphQLFacade;

class LoadDataToArrayAction
{
    /**
     * @param array<GraphqlRequestsPimcore> $queriesGeneral
     * @return void
     */
    public static function run(array $queriesGeneral): array
    {
        foreach ($queriesGeneral as $query) {
            $requestCustom = GraphQLFacade::executeQuery(
                $query->getEndpoint(),
                $query->getQuery(),
                $query->getXApiKey()
            );
            dd($requestCustom);
        }
        return [];
    }
}

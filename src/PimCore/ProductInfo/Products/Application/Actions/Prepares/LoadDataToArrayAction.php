<?php

namespace App\PimCore\ProductInfo\Products\Application\Actions\Prepares;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\Shared\Application\Facades\GraphQL\GraphQLFacade;


class LoadDataToArrayAction
{
    /**
     * @param array<GraphqlRequestsPimcore> $queriesGeneral
     * @return array
     */
    public static function run(array $queriesGeneral): array
    {
        $combinedResults = [];
        foreach ($queriesGeneral as $query) {
            try {
                $requestCustom = GraphQLFacade::executeQuery(
                    $query->getEndpoint(),
                    $query->getQuery(),
                    $query->getXApiKey()
                );

                if (array_key_exists('error', $requestCustom)) {
                    //TODO додати логування.
                }
                $result = reset($requestCustom['data']);

                $combinedResults = array_merge($combinedResults, $result);
            } catch (\Exception $e) {
                dd($requestCustom);
            }
        }

        return $combinedResults;
    }
}

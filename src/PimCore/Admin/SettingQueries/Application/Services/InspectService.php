<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\InspectServiceInterface;
use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
use App\Shared\Infrastructure\Http\GraphQL\GraphQLInterface;

readonly class InspectService implements InspectServiceInterface
{
    public function __construct(
        private GraphQLInterface $graphQL,
        private GraphqlRequestsPimcoreRepositoryInterface $graphqlRequestsPimcoreRepository)
    {
    }

    public function checkQuery(int $id)
    {
        /**
         * @var GraphqlRequestsPimcore $entity
         */
        $entity = $this->graphqlRequestsPimcoreRepository->find($id);

        return $this->graphQL->executeQuery($entity->getEndpoint(), $entity->getQuery(), $entity->getXApiKey());
    }
}

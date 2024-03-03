<?php

namespace App\Shared\Application\Serivces\GraphQl;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\PimCore\Admin\SettingQueries\Domain\Reposutories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
use App\Shared\Application\Serivces\GraphQl\Interfaces\GraphqlRequestsPimcoreServiceInterface;

class GraphqlRequestsPimcoreService implements GraphqlRequestsPimcoreServiceInterface
{
    public function __construct(private readonly GraphqlRequestsPimcoreRepositoryInterface $graphqlRequestsPimcoreRepository)
    {
    }

    public function getGraphQl(string $type): ?GraphqlRequestsPimcore
    {
        return $this->graphqlRequestsPimcoreRepository->getGraphQl($type);
    }
}

<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\TreeServiceInterface;
use App\PimCore\Admin\SettingQueries\Domain\Reposutories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;

class TreeService implements TreeServiceInterface
{
    public function __construct(private readonly GraphqlRequestsPimcoreRepositoryInterface $graphqlRequestsPimcoreRepository)
    {
    }

    public function getTree(): array
    {
        return $this->graphqlRequestsPimcoreRepository->getTree();
    }
}

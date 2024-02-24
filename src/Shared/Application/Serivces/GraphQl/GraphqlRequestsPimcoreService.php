<?php

namespace App\Shared\Application\Serivces\GraphQl;

use App\Shared\Application\Serivces\GraphQl\Interfaces\GraphqlRequestsPimcoreServiceInterface;
use App\Shared\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\Shared\Domain\Reposutories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;

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

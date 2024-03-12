<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\TreeServiceInterface;
use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;

class TreeService implements TreeServiceInterface
{
    public function __construct(private readonly GraphqlRequestsPimcoreRepositoryInterface $graphqlRequestsPimcoreRepository)
    {
    }

    public function getTree(): array
    {
        return $this->graphqlRequestsPimcoreRepository->getTree();
    }

    public function save(string $name): GraphqlRequestsPimcore
    {
        return $this->graphqlRequestsPimcoreRepository->save(
            (new GraphqlRequestsPimcore())
                ->setText($name));
    }

    public function remove(int $id): void
    {
        $this->graphqlRequestsPimcoreRepository->remove($id);
    }
}

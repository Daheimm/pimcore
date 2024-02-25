<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services;


use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\SettingQueriesServiceInterface;
use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\PimCore\Admin\SettingQueries\Domain\Reposutories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;

class SettingQueriesService implements SettingQueriesServiceInterface
{
    public function __construct(private readonly GraphqlRequestsPimcoreRepositoryInterface $graphqlRequestsPimcoreRepository)
    {
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->graphqlRequestsPimcoreRepository->getAll();
    }

    public function getById(int $id): GraphqlRequestsPimcore
    {
        return $this->graphqlRequestsPimcoreRepository->getById($id);
    }
}

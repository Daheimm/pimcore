<?php

namespace App\PimCore\Admin\SettingQueries\Domain\Reposutories\GraphQl;


use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

interface GraphqlRequestsPimcoreRepositoryInterface
{
    public function getGraphQl(string $type): ?GraphqlRequestsPimcore;

    public function getAll(): array;

    public function getTree(): array;

    public function getById(int $id): GraphqlRequestsPimcore;

    public function save(GraphqlRequestsPimcore $graphqlRequestsPimcore): GraphqlRequestsPimcore;

    public function remove(int $id): void;
}

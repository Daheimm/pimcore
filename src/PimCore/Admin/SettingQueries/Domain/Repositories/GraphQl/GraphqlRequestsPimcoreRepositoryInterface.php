<?php

namespace App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

interface GraphqlRequestsPimcoreRepositoryInterface
{
    public function getGraphQl(string $type): ?GraphqlRequestsPimcore;

    public function getAll(): array;

    public function getTree(): array;

    public function getById(int $id): ?GraphqlRequestsPimcore;

    public function getByTypeId(int $id): ?GraphqlRequestsPimcore;

    public function save(GraphqlRequestsPimcore $graphqlRequestsPimcore): GraphqlRequestsPimcore;

    public function update(GraphqlRequestsPimcore $graphqlRequestsPimcore): GraphqlRequestsPimcore;

    public function remove(int $id): void;
}

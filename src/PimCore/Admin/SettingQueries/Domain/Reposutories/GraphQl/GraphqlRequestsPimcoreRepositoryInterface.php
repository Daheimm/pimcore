<?php

namespace App\PimCore\Admin\SettingQueries\Domain\Reposutories\GraphQl;


use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

interface GraphqlRequestsPimcoreRepositoryInterface
{
    public function getGraphQl(string $type): ?GraphqlRequestsPimcore;

    public function getAll(): array;
}

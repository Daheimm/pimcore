<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services\Interfaces;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

interface SettingQueriesServiceInterface
{
    public function getAll(): array;

    public function getById(int $id): GraphqlRequestsPimcore;
}

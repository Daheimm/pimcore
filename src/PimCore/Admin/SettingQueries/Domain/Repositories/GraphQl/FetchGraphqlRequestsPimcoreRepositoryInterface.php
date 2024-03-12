<?php

namespace App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl;

interface FetchGraphqlRequestsPimcoreRepositoryInterface
{
    public function findByTypeIdWithEmptyEndpoint(int $typeId): array;

    public function findByTypeIdAndPath(int $typeId, string $path): array;
}

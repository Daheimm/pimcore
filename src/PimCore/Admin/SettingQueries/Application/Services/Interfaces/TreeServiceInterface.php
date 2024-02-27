<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services\Interfaces;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

interface TreeServiceInterface
{
    public function getTree(): array;

    public function save(string $name): GraphqlRequestsPimcore;

    public function remove(int $id): void;
}

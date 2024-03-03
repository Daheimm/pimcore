<?php

namespace App\Shared\Application\Serivces\GraphQl\Interfaces;



use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

interface GraphqlRequestsPimcoreServiceInterface
{
    public function getGraphQl(string $type): ?GraphqlRequestsPimcore;
}

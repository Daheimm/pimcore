<?php

namespace App\Shared\Domain\Reposutories\GraphQl;

use App\Shared\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

interface GraphqlRequestsPimcoreRepositoryInterface
{
    public function getGraphQl(string $type): ?GraphqlRequestsPimcore;
}

<?php

namespace App\Shared\Infrastructure\Repositories\GraphQl;

use App\Shared\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\Shared\Domain\Reposutories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GraphqlRequestsPimcoreRepository extends ServiceEntityRepository implements GraphqlRequestsPimcoreRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GraphqlRequestsPimcore::class);
    }

    public function getGraphQl(string $type): ?GraphqlRequestsPimcore
    {
        return $this->findOneBy(["type" => $type]);
    }
}

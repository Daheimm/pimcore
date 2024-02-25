<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Repositories\GraphQl;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;


use App\PimCore\Admin\SettingQueries\Domain\Reposutories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
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

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getTree(): array
    {
        return $this->findAll();
    }

    public function getById(int $id): GraphqlRequestsPimcore
    {
      return $this->find($id);
    }
}

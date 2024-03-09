<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Repositories\GraphQl;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

use App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GraphqlRequestsPimcoreRepository extends ServiceEntityRepository implements GraphqlRequestsPimcoreRepositoryInterface
{
    public function __construct(private ManagerRegistry $registry)
    {
        parent::__construct($this->registry, GraphqlRequestsPimcore::class);
    }

    public function getGraphQl(string $type): ?GraphqlRequestsPimcore
    {
        return $this->findOneBy(['typeId' => $type]);
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getTree(): array
    {
        return $this->findAll();
    }

    public function getByTypeId(int $id): ?GraphqlRequestsPimcore
    {
        return $this->findOneBy(['typeId' => $id]);
    }

    public function save(GraphqlRequestsPimcore $graphqlRequestsPimcore): GraphqlRequestsPimcore
    {
        $this->_em->persist($graphqlRequestsPimcore);
        $this->_em->flush();

        return $graphqlRequestsPimcore;
    }

    public function remove(int $id): void
    {
        $query = $this->_em->createQuery('DELETE FROM App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore g WHERE g.id = :id');
        $query->setParameter('id', $id);
        $query->execute();
    }

    public function update(GraphqlRequestsPimcore $graphqlRequestsPimcore): GraphqlRequestsPimcore
    {
        $this->_em->flush($graphqlRequestsPimcore);
        $this->_em->flush();

        return $graphqlRequestsPimcore;
    }
}

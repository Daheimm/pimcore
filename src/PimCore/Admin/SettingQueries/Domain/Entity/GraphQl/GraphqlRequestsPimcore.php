<?php

namespace App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl;

use App\PimCore\Admin\SettingQueries\Infrastructure\Repositories\GraphQl\GraphqlRequestsPimcoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GraphqlRequestsPimcoreRepository::class)]
#[ORM\Table(name: 'graphql_requests_pimcore')]
class GraphqlRequestsPimcore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;
    #[ORM\Column(type: 'string')]
    private string $type;
    #[ORM\Column(type: 'string')]
    private string $query;

    #[ORM\Column(type: 'string')]
    private string $xApiKey;

    public function getXApiKey(): string
    {
        return $this->xApiKey;
    }

    public function setXApiKey(string $xApiKey): void
    {
        $this->xApiKey = $xApiKey;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

}

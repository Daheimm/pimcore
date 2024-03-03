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
    #[ORM\Column(type: 'integer')]
    private ?int $typeId;
    #[ORM\Column(type: 'string')]
    private ?string $query;

    #[ORM\Column(type: 'string')]
    private ?string $xApiKey;
    #[ORM\Column(type: 'string')]
    private ?string $text;

    #[ORM\Column(type: 'string')]
    private ?string $endpoint;

    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    public function setEndpoint(?string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    private $leaf = true;

    public function isLeaf(): bool
    {
        return $this->leaf;
    }

    public function setLeaf(bool $leaf): void
    {
        $this->leaf = $leaf;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getXApiKey(): ?string
    {
        return $this->xApiKey;
    }

    public function setXApiKey(?string $xApiKey): self
    {
        $this->xApiKey = $xApiKey;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }

    public function setTypeId(?int $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): self
    {
        $this->query = $query;

        return $this;
    }
}

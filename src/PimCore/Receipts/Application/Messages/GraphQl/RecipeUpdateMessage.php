<?php

namespace App\PimCore\Receipts\Application\Messages\GraphQl;

use App\Shared\Domain\Entity\GraphQl\GraphqlRequestsPimcore;

class RecipeUpdateMessage
{
    const ROUTING_KEY = "products.event.recipe.update";

    public function __construct(
        private int                    $id,
        private GraphqlRequestsPimcore $graphqlRequestsPimcore)
    {
    }

    public function getGraphqlRequestsPimcore(): GraphqlRequestsPimcore
    {
        return $this->graphqlRequestsPimcore;
    }

    public function setGraphqlRequestsPimcore(GraphqlRequestsPimcore $graphqlRequestsPimcore): void
    {
        $this->graphqlRequestsPimcore = $graphqlRequestsPimcore;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}

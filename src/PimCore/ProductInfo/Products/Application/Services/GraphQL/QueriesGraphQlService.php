<?php

namespace App\PimCore\ProductInfo\Products\Application\Services\GraphQL;

use App\PimCore\ProductInfo\Products\Application\Services\Interfaces\QueriesGraphQlServiceInterface;
use App\Shared\Infrastructure\Http\GraphQL\Async\GraphQLAsyncInterface;
use React\Promise\PromiseInterface;

readonly class QueriesGraphQlService implements QueriesGraphQlServiceInterface
{
    public function __construct(private GraphQLAsyncInterface $graphQLAsync)
    {
    }

    public function query(string $endpoint, string $query, string $xApiKey): PromiseInterface
    {
        return $this->graphQLAsync->executeQueryAsync($endpoint, $query, $xApiKey);
    }

}

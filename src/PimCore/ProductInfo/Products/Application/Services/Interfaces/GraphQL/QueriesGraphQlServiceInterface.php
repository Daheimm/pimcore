<?php

namespace App\PimCore\ProductInfo\Products\Application\Services\Interfaces\GraphQL;

use React\Promise\PromiseInterface;

interface QueriesGraphQlServiceInterface
{
    public function query(string $endpoint, string $query, string $xApiKey): PromiseInterface;
}

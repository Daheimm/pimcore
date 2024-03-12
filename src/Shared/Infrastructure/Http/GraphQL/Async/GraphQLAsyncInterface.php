<?php

namespace App\Shared\Infrastructure\Http\GraphQL\Async;

use React\Promise\PromiseInterface;

interface GraphQLAsyncInterface
{
    public function executeQueryAsync(string $endpoint, string $query, string $xApiKey): PromiseInterface;
}

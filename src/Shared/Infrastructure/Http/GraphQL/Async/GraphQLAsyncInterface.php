<?php

namespace App\Shared\Infrastructure\Http\GraphQL\Async;

interface GraphQLAsyncInterface
{
    public function executeQueryAsync(string $endpoint, string $query, string $xApiKey): void;
}

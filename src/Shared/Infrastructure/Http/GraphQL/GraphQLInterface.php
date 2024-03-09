<?php

namespace App\Shared\Infrastructure\Http\GraphQL;

interface GraphQLInterface
{
    public function executeQuery(string $endpoint, string $query, string $xApiKey): array;
}

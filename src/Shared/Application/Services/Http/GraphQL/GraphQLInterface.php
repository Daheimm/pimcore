<?php

namespace App\Shared\Application\Services\Http\GraphQL;

interface GraphQLInterface
{
    public function executeQuery(string $endpoint, string $query, string $xApiKey): array;
}

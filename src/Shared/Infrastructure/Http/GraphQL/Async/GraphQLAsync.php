<?php

namespace App\Shared\Infrastructure\Http\GraphQL\Async;

use App\Shared\Infrastructure\Http\HttpGraphQLAsyncAbstract;
use React\Promise\PromiseInterface;


class GraphQLAsync extends HttpGraphQLAsyncAbstract implements GraphQLAsyncInterface
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = $this->params->get('LOCALHOST.BASE.URL');
        parent::__construct();
    }

    /**
     * @param string $endpoint
     * @param string $query
     * @param string $xApiKey
     *
     * @return PromiseInterface
     *
     */
    public function executeQueryAsync(string $endpoint, string $query, string $xApiKey): PromiseInterface
    {
        return $this->browser->post(sprintf("%s/%s", $this->baseUrl, $endpoint),
            [
                'X-API-Key' => $xApiKey
            ], $query);
    }
}

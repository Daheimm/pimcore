<?php

namespace App\Shared\Infrastructure\Http\GraphQL\Async;

use PHPUnit\Logging\Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use React\Http\Browser;

class GraphQLAsync implements GraphQLAsyncInterface
{
    // private readonly Browser $browser ;
    public function __construct()
    {
        //    $this->browser = new React\Http\Browser();
    }

    /**
     * @param string $endpoint
     * @param string $query
     * @param string $xApiKey
     *
     * @return array
     *
     */
    public function executeQueryAsync(string $endpoint, string $query, string $xApiKey): void
    {
        //  $browser->get('https://example.com/')
    }
}

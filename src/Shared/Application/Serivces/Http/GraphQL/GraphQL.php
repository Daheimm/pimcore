<?php

namespace App\Shared\Application\Serivces\Http\GraphQL;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GraphQL implements GraphQLInterface
{
    public function __construct(private readonly HttpClientInterface $pimCore)
    {
    }

    /**
     * @param string $endpoint
     * @param string $query
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function executeQuery(string $endpoint, string $query): array
    {

        try {
            /**
             * @var HttpClientInterface $pimCore
             */
            $response = $this->pimCore->request('POST', $endpoint, [
                'json' => [
                    'query' => $query,
                ],
                'headers' => [
                    'X-API-Key' => 'cc80d5ae912b8e6c2d9ecfd0033f4556'
                ]
            ]);

            $content = $response->toArray(); // Перетворює JSON відповідь на масив
        } catch (\Throwable $e) {
            dd($e);
        }

        return $content;
    }
}


<?php

namespace App\Shared\Application\Serivces\Http\GraphQL;

use PHPUnit\Logging\Exception;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GraphQL implements GraphQLInterface
{
    public function __construct(
        private readonly HttpClientInterface $pimCore,
        private readonly LoggerInterface $logger)
    {
    }

    /**
     * @param string $endpoint
     * @param string $query
     * @param string $xApiKey
     *
     * @return array
     *
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function executeQuery(string $endpoint, string $query, string $xApiKey): array
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
                    'X-API-Key' => $xApiKey
                ]
            ]);
            $content = $response->toArray();
        } catch (\Throwable $e) {
            $this->logger->error($e);
            throw new Exception($e);
        }

        return $content;
    }
}

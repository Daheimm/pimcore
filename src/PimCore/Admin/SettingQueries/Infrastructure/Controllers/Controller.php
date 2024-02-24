<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class Controller extends AbstractController
{
    private SerializerInterface $serializer;

    /**
     * @param array|object $body
     * @return JsonResponse
     */
    public function response(array|object $body): JsonResponse
    {
        $json = $this->serializer->serialize([
            'success' => true,
            'message' => '',
            'data' => $body,
        ], 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Required]
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }
}

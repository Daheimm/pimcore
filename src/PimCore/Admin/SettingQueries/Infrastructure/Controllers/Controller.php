<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class Controller extends AbstractController
{
    private SerializerInterface $serializer;

    /**
     * @param array|object $body
     * @return Response
     */
    public function response(array|object $body): Response
    {

        return new Response($this->serializer->serialize($body, 'json'));
    }

    #[Required]
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }
}

<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class Controller extends AbstractController
{
    protected SerializerInterface $serializer;
    protected ValidatorInterface $validator;

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

    public function responseJustStruct(array|object $body): JsonResponse
    {
        $json = $this->serializer->serialize($body, 'json');

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    /**
     * @param object $object
     * @return void
     */
    protected function validation(object $object): void
    {
        $errors = $this->validator->validate($object);

        if (count($errors) > 0) {
            throw new ValidationFailedException($object, $errors);
        }
    }

    #[Required]
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    #[Required]
    public function setValidator(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }
}

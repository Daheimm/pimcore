<?php

namespace App\Shared\Application\RabbitMQ\Messages\ObjectData;

class ObjectDataMessage
{
    const ROUTE_MESSAGE = 'shared.object_data.change';

    public function __construct(
        private string $method,
        private string $class,
        private string $pathFolder,
        private int    $id,
        private int    $classDefinitionId
    )
    {
    }

    public function getPathFolder(): string
    {
        return $this->pathFolder;
    }

    public function setPathFolder(string $pathFolder): void
    {
        $this->pathFolder = $pathFolder;
    }

    public function getClassDefinitionId(): int
    {
        return $this->classDefinitionId;
    }

    public function setClassDefinitionId(int $classDefinitionId): void
    {
        $this->classDefinitionId = $classDefinitionId;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}

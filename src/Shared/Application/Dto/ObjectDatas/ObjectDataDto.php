<?php

namespace App\Shared\Application\Dto\ObjectDatas;

final class ObjectDataDto
{
    public function __construct(
        private string $method,
        private string $class,
        private string $pathFolder,
        private int    $id,
        private int    $classDefinitionId
    )
    {
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;
        return $this;
    }

    public function getPathFolder(): string
    {
        return $this->pathFolder;
    }

    public function setPathFolder(string $pathFolder): self
    {
        $this->pathFolder = $pathFolder;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getClassDefinitionId(): int
    {
        return $this->classDefinitionId;
    }

    public function setClassDefinitionId(int $classDefinitionId): self
    {
        $this->classDefinitionId = $classDefinitionId;
        return $this;
    }

}

<?php

namespace App\Shared\Application\RabbitMQ\Messages\ObjectData;

class ObjectDataMessage
{
    const ROUTE_MESSAGE = 'shared.object_data.change';

    public function __construct(
        private string $method,
        private string $class,
        private int    $id,
    )
    {
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

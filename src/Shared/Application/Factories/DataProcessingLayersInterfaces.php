<?php

namespace App\Shared\Application\Factories;

interface DataProcessingLayersInterfaces
{
    public function createHandler(string $type, object $object, string $eventName);
}

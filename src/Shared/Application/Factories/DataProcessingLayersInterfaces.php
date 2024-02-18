<?php

namespace App\Shared\Application\Factories;

use App\Shared\Application\Serivces\ServicesInterfaces;

interface DataProcessingLayersInterfaces
{
    public function createHandler(string $type, object $object, string $eventName);
}

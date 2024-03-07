<?php

namespace App\PimCore\Products\Application\Actions\Reflactions;

use ReflectionClass;

class GetNamePropertiesClassAction
{
    public static function run(object $obj): array
    {
        $classVars = [];

        $reflectionClass = new ReflectionClass($obj);

        foreach ($reflectionClass->getProperties() as $property) {
            if ($property->getDeclaringClass()->getName() === $reflectionClass->getName()) {
                $propertyName = $property->getName();
                $classVars[] = $propertyName;
            }
        }
        return $classVars;
    }
}

<?php

namespace App\PimCore\Products\Application\Actions\Extracts;

use App\PimCore\Products\Application\Actions\Reflactions\GetNamePropertiesClassAction;
use Pimcore\Model\DataObject\Recipe;


class GetObjectVarsJustFields
{
    public static function run(?object $object): array
    {
        try {
            $arr = [];

            if (!$object) {
                return [];
            }

            $fieldsName = GetNamePropertiesClassAction::run($object);
            foreach ($fieldsName as $field) {
                if (!is_object($object->get($field)) && !is_array($object->get($field))) {
                    $arr[$field] = $object->get($field);
                } elseif ($field === "localizedfields") {
                    $arr[$field] = $object?->getLocalizedfields()?->getItems();
                }
            }
        } catch (\Throwable $exception) {

        }
        return $arr;
    }
}

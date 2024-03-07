<?php

namespace App\PimCore\Products\Application\Actions\Extracts;

use App\PimCore\Products\Application\Actions\Reflactions\GetNamePropertiesClassAction;
use Pimcore\Model\DataObject\Fieldcollection;

class GetObjectVarsWithObject
{
    public static function run(?object $object): array
    {
        try {
            $arr = [];

            if (!$object) {
                return [];
            }

            if ($object instanceof Fieldcollection) {
                foreach ($object->getItems() as $item) {
                    $arr[$item->getFieldname()] = GetObjectVarsJustFields::run($item);
                }
                return $arr;
            }
            $fieldsName = GetNamePropertiesClassAction::run($object);

            foreach ($fieldsName as $field) {
                if ($field === "localizedfields") {
                    $arr[$field] = $object?->getLocalizedfields()?->getItems();
                } else if (is_object($object->get($field))) {
                    $arr[$field] = GetObjectVarsJustFields::run($object->get($field));
                } else if (is_array($object->get($field))) {
                    foreach ($object->get($field) as $item) {
                        $arr[] = GetObjectVarsJustFields::run($item);
                    }
                    $arr[$field] = $arr;

                }
            }
        } catch (\Throwable $exception) {
            dd($exception);
        };

        return $arr;
    }
}

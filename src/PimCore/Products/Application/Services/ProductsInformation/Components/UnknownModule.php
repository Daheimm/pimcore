<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsWithObject;
use Pimcore\Model\DataObject\Product;

class UnknownModule extends ComponentsAbstract
{
    private array $ignore = [
        "localizedfields",
        "subcategoryrelation",
        "sabotagecategoryname",
        "categorysabotage",
    ];

    public function proccess(Product $product, string $field = null): array|int|string|null
    {
        $arrFields = null;


        if (!$field) {
            return null;
        }
        try {

            $unknownClass = $product->get($field);

            if (!$unknownClass) {
                return null;
            }
            $arrTemp = [];
            //Отримання простих полів, якщо будуть динамічно додаватися до продуктів.
            if (!is_object($unknownClass) && !is_array($unknownClass)) {
                return $unknownClass;

            } elseif (in_array($field, $this->ignore)) {

            } elseif (is_object($unknownClass)) {
                $arrFields = $this->getObjectVars($unknownClass, $field);
            } elseif (is_array($unknownClass)) {
                foreach ($unknownClass as $class) {
                    $arrTemp[] = $this->getObjectVars($class);

                }
                return $arrTemp;
            }
        } catch (\Exception $e) {
            $this->logger->error($e);
            return $arrFields;
        }

        return $arrFields;
    }

    private function getObjectVars(object $object, string $field = null)
    {
        $arrFields = $arrObject = [];
        try {
            $arrFields = GetObjectVarsJustFields::run($object);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }

        try {
            $arrObject = GetObjectVarsWithObject::run($object);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return array_merge($arrFields, $arrObject);
    }
}

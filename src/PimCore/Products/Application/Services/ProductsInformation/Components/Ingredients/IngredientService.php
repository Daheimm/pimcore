<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Ingredients;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsWithObject;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Fieldcollection;
use Pimcore\Model\DataObject\Product;

class IngredientService extends ComponentsAbstract
{
    public function proccess(Product $product): array
    {
        $arr = $arrField = $arrObject = [];
        /**
         * @var Fieldcollection $ingradientCollection
         */
        try {
            $ingradientCollection = $product->get(Product::FIELD_INGREDIENTS);

            if (!$ingradientCollection) {
                return [];
            }
            foreach ($ingradientCollection->getItems() as $ingradient) {
                $arrField = GetObjectVarsJustFields::run($ingradient);
                $arrObject = GetObjectVarsWithObject::run($ingradient);

                $arr[] = array_merge($arrField, $arrObject);
            }

            if (!$arr) {
                return [];
            }
        } catch (\Exception $e) {

            $this->logger->error($e);
        }

        return $arr;
    }
}

<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Productsets;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsWithObject;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Fieldcollection;
use Pimcore\Model\DataObject\Product;

class ProductService extends ComponentsAbstract
{
    public function proccess(Product $product): array|null
    {
        $arr = null;
        /**
         * @var Fieldcollection $products
         */
        try {

            $products = $product->get(Product::FIELD_PRODUCTSETS);
            if (!$products) {
                return null;
            }

            foreach ($products->getItems() as $product) {
                $arrFields = GetObjectVarsJustFields::run($product);
                $arrObject = GetObjectVarsWithObject::run($product);
                $arr[] = array_merge($arrFields, $arrObject);
            }

            if (!$arr) {
                return null;
            }
        } catch (\Exception $e) {
            $this->logger->error($e);
        }

        return $arr;
    }
}

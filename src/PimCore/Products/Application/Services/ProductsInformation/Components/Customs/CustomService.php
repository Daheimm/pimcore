<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Customs;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsWithObject;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Product;

class CustomService extends ComponentsAbstract
{
    public function proccess(Product $product): array|null
    {
        $arr = null;
        /**
         * @var Product\Customfeatures $customClass ;
         */
        try {
            $customClass = $product->get(Product::FIELD_CUSTOMFEATURES);

            foreach ($customClass->getItems() as $item) {
                $arrFields = GetObjectVarsJustFields::run($item);
                $arrObject = GetObjectVarsWithObject::run($item);

                $arr[$item->getType()] = array_merge($arrFields, $arrObject);
            }
        } catch (\Exception $e) {
            $this->logger->error($e);
        }
        return $arr;
    }
}

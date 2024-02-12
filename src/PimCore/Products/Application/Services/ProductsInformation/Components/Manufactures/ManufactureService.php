<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Manufactures;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Product;

class ManufactureService extends ComponentsAbstract
{
    public function proccess(Product $product): array
    {
        $arr =  null;

        try {
            $countryClass = $product->get(Product::FIELD_MANUFACTURERELATOIN);
            $arr = GetObjectVarsJustFields::run($countryClass);
            if (!$arr) {
                return [];
            }
            $arr['path'] = $countryClass->getPath();
        } catch (\Exception $e) {
            $this->logger->error($e);
        }
        return $arr;
    }
}

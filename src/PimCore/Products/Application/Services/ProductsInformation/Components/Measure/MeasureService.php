<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Measure;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\MeasureUnit;
use Pimcore\Model\DataObject\Product;

class MeasureService extends ComponentsAbstract
{
    public function proccess(Product $product): array
    {
        $arr = null;
        try {
            /**
             * @var MeasureUnit $measureClass
             */
            $measureClass = $product->get(Product::FIELD_MEASUREELATIONS);
            if (!$measureClass) {
                return [];
            }
            $arr = GetObjectVarsJustFields::run($measureClass);
        } catch (\Exception $e) {
            $this->logger->error($e);
        }
        $arr['path'] = $measureClass->getPath();
        return $arr;
    }
}


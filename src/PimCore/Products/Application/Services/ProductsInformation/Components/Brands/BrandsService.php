<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Brands;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\Product;

class BrandsService extends ComponentsAbstract
{
    public function proccess(Product $product): array
    {
        try {
            /**
             * @var Brand $brandsClass
             */
            $brandsClass = $product->get(Product::FIELD_BRANDRELATIONS);
            if (!$brandsClass) {
                return [];
            }
            $arr = GetObjectVarsJustFields::run($brandsClass);
            $arr["path"] = $brandsClass?->getPath();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return [];
        }
        return $arr;
    }
}

<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Countries;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use \Pimcore\Model\DataObject\Fieldcollection;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Product;

class CountryService extends ComponentsAbstract
{
    public function proccess(Product $product): array
    {
        $arr = [Product::FIELD_COUNTRURELATIONS => null];
        try {
            $countryClass = $product->get(Product::FIELD_COUNTRURELATIONS);
            $arr = GetObjectVarsJustFields::run($countryClass);

            $arr['path'] = $countryClass?->getPath();
        } catch (\Exception $e) {
            $this->logger->error($e);
        }

        return $arr;
    }
}

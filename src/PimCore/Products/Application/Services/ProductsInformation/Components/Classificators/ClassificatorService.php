<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Classificators;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\DataObject\ProductClassificator;

class ClassificatorService extends ComponentsAbstract
{
    public function proccess(Product $product): array
    {
        $arr = null;
        /**
         * @var ProductClassificator $classificator
         */
        try {
            $classificator = $product->get(Product::FIELD_CLASSIFICATOR);
            $arr = GetObjectVarsJustFields::run($classificator);

            if (!$arr) {
                return [];
            }
            $arr['path'] = $classificator->getPath();
        } catch (\Exception $e) {
            $this->logger->error($e);
        }

        return $arr;
    }
}

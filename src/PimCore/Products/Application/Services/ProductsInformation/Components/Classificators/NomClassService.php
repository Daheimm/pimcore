<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Classificators;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Actions\Reflactions\GetNamePropertiesClassAction;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\DataObject\VariantNomClass1;

class NomClassService extends ComponentsAbstract
{
    public function proccess(Product $product, string $field): array
    {
        $arr = null;
        try {
            $nomClass = $product->get($field);
            $arr = GetObjectVarsJustFields::run($nomClass);

            if (!$arr) {
                return [];
            }
            $arr['path'] = $nomClass->getPath();
        } catch (\Exception $e) {
            $this->logger->error($e);
        }
        return $arr;
    }
}

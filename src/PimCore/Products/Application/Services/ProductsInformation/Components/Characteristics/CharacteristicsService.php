<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Characteristics;

use App\PimCore\Products\Application\Actions\Extracts\GetObjectVarsJustFields;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Product;

class CharacteristicsService extends ComponentsAbstract
{
    public function proccess(Product $product): array|null
    {
        $arrTemplate = null;
        /**
         * @var Product\Characteristics $characteristics ;
         */
        try {
            $characteristics = $product->get(Product::FIELD_CHARACTERISTICS);


            foreach ($characteristics->getItems() as $item) {
                $arrTemplate[$item->getType()] = GetObjectVarsJustFields::run($item);
            }
        } catch (\Exception $e) {
            $this->logger->error($e);
        }
        return $arrTemplate;
    }
}

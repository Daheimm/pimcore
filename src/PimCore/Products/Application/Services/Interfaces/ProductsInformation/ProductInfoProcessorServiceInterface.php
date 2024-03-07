<?php

namespace App\PimCore\Products\Application\Services\Interfaces\ProductsInformation;

use Pimcore\Model\DataObject;

interface ProductInfoProcessorServiceInterface
{
    /**
     * @param array<DataObject> $products
     * @return array
     */
    public function extract(array $products): array;

}

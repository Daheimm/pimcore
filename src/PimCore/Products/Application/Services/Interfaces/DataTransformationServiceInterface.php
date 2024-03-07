<?php

namespace App\PimCore\Products\Application\Services\Interfaces;

use App\PimCore\Products\Application\Dto\ProductPrepareForMagentoDto;
use Pimcore\Model\DataObject\Product;

interface DataTransformationServiceInterface
{
    public function prepare(Product $product): ProductPrepareForMagentoDto;
}

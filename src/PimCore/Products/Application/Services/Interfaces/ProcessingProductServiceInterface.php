<?php

namespace App\PimCore\Products\Application\Services\Interfaces;

use Pimcore\Model\DataObject\Product;

interface ProcessingProductServiceInterface
{
    public function processingUpdate(?Product $products);
}

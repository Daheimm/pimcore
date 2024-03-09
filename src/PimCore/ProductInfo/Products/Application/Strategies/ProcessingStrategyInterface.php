<?php

namespace App\PimCore\ProductInfo\Products\Application\Strategies;

use Pimcore\Model\DataObject\Product;

interface ProcessingStrategyInterface
{
    /**
     * @param string $className
     * @return mixed
     */
    public function support(string $className);

    /**
     * @param int $id
     * @return mixed
     */
    public function process(int $id);
}

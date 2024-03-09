<?php

namespace App\PimCore\ProductInfo\Products\Application\Strategies;

use Pimcore\Model\DataObject\Product;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.strategy.product')]
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
    public function process(int $id, int $classDefinitionId);
}

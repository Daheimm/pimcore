<?php

namespace App\PimCore\ProductInfo\Products\Application\Strategies;


use Pimcore\Model\DataObject\Product;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem(index: 'app.strategy.product')]
class ProductStrategy implements ProcessingStrategyInterface
{
    public function process(int $id)
    {

    }

    public function support(string $className)
    {
        return Product::class === $className;
    }
}

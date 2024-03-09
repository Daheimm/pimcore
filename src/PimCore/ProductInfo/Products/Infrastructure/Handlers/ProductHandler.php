<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\Handlers;

use App\PimCore\ProductInfo\Products\Application\Strategies\ProcessingStrategyInterface;

class ProductHandler
{
    public function __construct(private readonly iterable $strategies)
    {
    }

    public function handler(string $className, int $id,int $classDefinitionId): void
    {
        /**
         * @var $strategy ProcessingStrategyInterface
         */

        foreach ($this->strategies as $strategy) {

            if ($strategy->support($className)) {
                $strategy->process($id,$classDefinitionId);
                break;
            }
        }
    }
}

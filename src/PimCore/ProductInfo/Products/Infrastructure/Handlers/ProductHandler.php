<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\Handlers;

use App\PimCore\ProductInfo\Products\Application\Strategies\ProcessingStrategyInterface;

class ProductHandler
{
    public function __construct(private readonly iterable $strategies)
    {
    }

    public function handler(string $className, int $id): void
    {
        dd($this->strategies);
        /**
         * @var $strategy ProcessingStrategyInterface
         */
        foreach ($this->strategies as $strategy) {
            if ($strategy->support($className)) {
                $strategy->process($id);
                break;
            }
        }
    }
}

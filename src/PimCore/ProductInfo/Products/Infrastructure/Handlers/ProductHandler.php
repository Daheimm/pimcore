<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\Handlers;

use App\PimCore\ProductInfo\Products\Application\Strategies\ProcessingStrategyInterface;
use App\Shared\Application\Dto\ObjectDatas\ObjectDataDto;

class ProductHandler
{
    public function __construct(private readonly iterable $strategies)
    {
    }

    public function handler(ObjectDataDto $objectDataDto): void
    {
        /**
         * @var $strategy ProcessingStrategyInterface
         */

        foreach ($this->strategies as $strategy) {

            if ($strategy->support($objectDataDto->getClass())) {
                $strategy->process($objectDataDto);
                break;
            }
        }
    }
}

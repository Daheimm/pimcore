<?php

namespace App\PimCore\ProductInfo\Products\Application\Strategies;

use App\Shared\Application\Dto\ObjectDatas\ObjectDataDto;
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
     * @param ObjectDataDto $objectDataDto
     * @return mixed
     */
    public function process(ObjectDataDto $objectDataDto);
}

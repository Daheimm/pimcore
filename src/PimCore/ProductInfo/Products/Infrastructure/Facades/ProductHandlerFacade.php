<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\Facades;

use App\PimCore\ProductInfo\Products\Infrastructure\Handlers\ProductHandler;
use App\Shared\Application\Dto\ObjectDatas\ObjectDataDto;
use Lagdo\Symfony\Facades\AbstractFacade;

/**
 * @method static void handler(ObjectDataDto $objectDataDto) Handles the given ObjectDataDto.
 */
class ProductHandlerFacade extends AbstractFacade
{
    /**
     * @return string
     */
    protected static function getServiceIdentifier(): string
    {
        return ProductHandler::class;
    }
}

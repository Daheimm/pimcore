<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\Facades;

use App\PimCore\ProductInfo\Products\Infrastructure\Handlers\ProductHandler;
use Lagdo\Symfony\Facades\AbstractFacade;

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

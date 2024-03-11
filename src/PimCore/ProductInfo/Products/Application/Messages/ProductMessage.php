<?php

namespace App\PimCore\ProductInfo\Products\Application\Messages;

final class ProductMessage
{
    const ROUTE_KEY = 'products.event.updated';

    public function __construct(public array $data)
    {
    }
}

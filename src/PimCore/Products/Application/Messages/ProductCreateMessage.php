<?php

namespace App\PimCore\Products\Application\Messages;

use App\PimCore\Products\Application\Dto\ProductPrepareForMagentoDto;

final class ProductCreateMessage
{
    public const ROUTING_KEY = 'products.update';

    public function __construct(private array $products)
    {
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }
}

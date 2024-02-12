<?php

namespace App\PimCore\Products\Application\Messages\Exports;

class ProductExportsMessage
{
    public const ROUTING_KEY = 'products.import.all';

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

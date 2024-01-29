<?php

namespace App\PimCore\Products\Application\Messages;

use App\PimCore\Products\Application\Dto\ProductPrepareForMagentoDto;

final class ProductCreateMessage
{
    public const ROUTING_KEY = 'products.update';

    public function __construct(private ProductPrepareForMagentoDto $products)
    {
    }

    public function getProducts(): ProductPrepareForMagentoDto
    {
        return $this->products;
    }

    public function setProducts(ProductPrepareForMagentoDto $products): void
    {
        $this->products = $products;
    }
}

<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Categories;

use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Product;

class RootCatRelationsComponents extends ComponentsAbstract
{
    public function proccess(Product $product): array
    {
        $categoriesArray = [];
        /**
         * @var Product $product
         * @var Category $category
         */
        try {
            foreach ($product->get("rootcatrelations") as $category) {
                $categoriesArray[] = $category->getLocalizedfields()->getItems();

            }
        } catch (\Exception $e) {
            $this->logger->error($e);
        }
        return $categoriesArray;
    }
}

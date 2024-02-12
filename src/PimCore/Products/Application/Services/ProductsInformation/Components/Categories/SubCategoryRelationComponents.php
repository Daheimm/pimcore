<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Categories;

use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject\Product;

class SubCategoryRelationComponents extends ComponentsAbstract
{
    public function proccess(Product $product): array|null
    {
        $categoriesArray = null;
        /**
         * @var Product $product
         * @var Category $category
         */

        try {
            foreach ($product->getSubcategoryrelation() as $category) {
                $categoriesArray[] = $category->getLocalizedfields()->getItems();
            }

        } catch (\Exception $e) {
            $this->logger->error($e);
        }
        return $categoriesArray;
    }
}

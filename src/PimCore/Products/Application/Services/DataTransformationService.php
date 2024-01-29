<?php

namespace App\PimCore\Products\Application\Services;

use App\PimCore\Products\Application\Dto\General;
use App\PimCore\Products\Application\Dto\NameAndDescription;
use App\PimCore\Products\Application\Dto\ProductPrepareForMagentoDto;
use Pimcore\Model\DataObject\Product;

class DataTransformationService implements Interfaces\DataTransformationServiceInterface
{
    public function prepare(Product $product): ProductPrepareForMagentoDto
    {

        $products = new ProductPrepareForMagentoDto();

        $categoriesRelations = $product->getCategoriesrelations();
        $variantRelations = $product->getVariantrelation();

        $categoryPath = isset($categoriesRelations[0]) ? $categoriesRelations[0]->getPath() : null;
        $categoryKey = isset($categoriesRelations[0]) ? $categoriesRelations[0]->getKey() : null;
        $variantKey = isset($variantRelations[0]) ? $variantRelations[0]->getKey() : null;


        $products->setCategory(
            $products->getCategory()
                ->setRootCategory($categoryPath)
                ->setCategory($categoryKey)
                ->setVariant($variantKey)
        );

        $products->setArticle($product->getItemnumber())
            ->setId($product->getId());

        $products->setPrice($product->getProductprice())
            ->setStatus($product->getStatus())
            ->setproductSize($product->getProductsize())
            ->setPackingType($product->getPackingtype());

        $general = new General();

        foreach ($product->getLocalizedfields()->getItems() as $locale => $localized) {
            $nameAndDescription = (new NameAndDescription())
                ->setMobileDescription($localized['materialmobile'] ?? null)
                ->setWebDescription($localized['materialweb'] ?? null)
                ->setWarehouse($localized['productcomposition'] ?? null)
                ->setProductName($localized['productname'] ?? null)
                ->setWebProductName($localized['webname'] ?? null)
                ->setMobileProductName($localized['mobilename'] ?? null);


            $general->addNameAndDescription($locale, $nameAndDescription);
        }
        $products->setGeneral($general);

        return $products;
    }
}

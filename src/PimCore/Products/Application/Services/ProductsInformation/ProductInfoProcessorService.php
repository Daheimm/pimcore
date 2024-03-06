<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation;

use App\PimCore\Products\Application\Actions\Reflactions\GetNamePropertiesClassAction;
use App\PimCore\Products\Application\Services\Interfaces\ProductsInformation\ProductInfoProcessorServiceInterface;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Brands\BrandsService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Categories\CategoriesComponents;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Categories\RootCatRelationsComponents;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Categories\SubCategoryRelationComponents;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Characteristics\CharacteristicsService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Classificators\ClassificatorService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Classificators\NomClassService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Countries\CountryService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Customs\CustomService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Ingredients\IngredientService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Manufactures\ManufactureService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Measure\MeasureService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Media\PhotoService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\Productsets\ProductService;
use App\PimCore\Products\Application\Services\ProductsInformation\Components\UnknownModule;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Product;


class ProductInfoProcessorService implements ProductInfoProcessorServiceInterface
{
    /**
     * @param array<DataObject> $products
     * @return array
     */
    public function extract(array $products): array
    {
        /**
         * @var Product $product
         */
        $result = [];
        foreach ($products as $product) {
            $fieldsName = GetNamePropertiesClassAction::run($product);
            $temporaryArray = [];

           // dd($product->get('recipescollection'));

            foreach ($fieldsName as $field) {
                $temporaryArray[$field] = match ($field) {
                    Product::FIELD_CATEGORIESRELATIONS => (new CategoriesComponents())->proccess($product),
                    Product::FIELD_ROOTCATRELATIONS => (new RootCatRelationsComponents())->proccess($product),
                    Product::FIELD_SUBCATEGORYRELATION => (new SubCategoryRelationComponents)->proccess($product),
                    Product::FIELD_CLASSIFICATOR => (new ClassificatorService())->proccess($product),
                    Product::FIELD_NOMCLASS1 => (new NomClassService())->proccess($product, $field),
                    Product::FIELD_NOMCLASS2 => (new NomClassService())->proccess($product, $field),
                    Product::FIELD_NOMCLASS3 => (new NomClassService())->proccess($product, $field),
                    Product::FIELD_NOMCLASS4 => (new NomClassService())->proccess($product, $field),
                    Product::FIELD_MEASUREELATIONS => (new MeasureService())->proccess($product),
                    Product::FIELD_COUNTRURELATIONS => (new CountryService())->proccess($product),
                    Product::FIELD_BRANDRELATIONS => (new BrandsService())->proccess($product),
                    Product::FIELD_MANUFACTURERELATOIN => (new ManufactureService())->proccess($product),
                    Product::FIELD_CHARACTERISTICS => (new CharacteristicsService())->proccess($product),
                    Product::FIELD_CUSTOMFEATURES => (new CustomService())->proccess($product),
                    Product::FIELD_INGREDIENTS => (new IngredientService())->proccess($product),
                    Product::FIELD_PRODUCTSETS => (new ProductService())->proccess($product),
                    Product::FIELD_FOTOPRODUCT => (new PhotoService())->proccess($product),
                    default => (new UnknownModule())->proccess($product, $field),
                };
            }


            $temporaryArray["localizedfields"] = $product->getLocalizedfields()->getItems();

            $result[] = $temporaryArray;

        }

        return $result;
    }
}

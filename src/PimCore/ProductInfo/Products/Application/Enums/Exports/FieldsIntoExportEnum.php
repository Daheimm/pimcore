<?php

namespace App\PimCore\ProductInfo\Products\Application\Enums\Exports;

enum FieldsIntoExportEnum: string
{
    case Measureelations = 'measureelations';      // Базова Од. вимірювання
    case AlternativeUOM = 'alternativeuom';       // Альтернативна Од. вимірювання
    case ManufacturerRelation = 'manufacturerelatoin';  // Виробник
    case CountryRelations = 'countrurelations';     // Країна виробництва
    case BrandRelations = 'brandrelations';       // Бренд
    case CountryBrand = 'countrubrand';         // Країна бренду
    case LineProductRelation = 'lineproductrelatoin';  // Лінія продукту
    case RootCatRelations = 'rootcatrelations';     // Категорія (1 рівень)
    case CategoriesRelations = 'categoriesrelations';  // Категорія (2 рівень)
    case VariantRelations = 'variantrelations';     // Варіант (3 рівень)
    case SubcategoryRelation = 'subcategoryrelation';  // Субкатегорія (3 рівень)
}

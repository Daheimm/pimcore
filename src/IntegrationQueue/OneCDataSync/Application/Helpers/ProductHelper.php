<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 01.09.2021 14:25
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;

use Pimcore\Model\DataObject\Product;

class ProductHelper
{
    public static function checkIfProductExist(string $productCode)
    {
        $product = Product::getByCode($productCode, ['limit' => 1]);
        if (empty($product)) {
            echo 'Create new product: ' . $productCode . PHP_EOL;
            $product = new Product();
            $product
                ->setParentId($_ENV['PRODUCT_NEW_PARENTID'])
                ->setCode($productCode)
                ->setKey($productCode)
                ->setPublished(true);
            if ($product->save()) {
                echo 'Saved new product when handle product ' . $productCode . PHP_EOL;
            } else {
                echo 'product not saved:' . $productCode . PHP_EOL;
            }
        } else {
            echo 'Found product product when handle product : ' . $productCode . PHP_EOL;
        }
        return $product;
    }
}

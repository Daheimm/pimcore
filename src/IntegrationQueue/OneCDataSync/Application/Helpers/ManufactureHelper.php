<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 26.02.2021 11:34
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;


use Pimcore\Model\DataObject\ProductTM;

class ManufactureHelper
{
    public static function checkManufactureExist(string $code)
    {
        $tm = ProductTM::getByCode($code, ['limit' => 1]);
        if (empty($tm)) {
            echo 'Create new TM when handle product: ' . $code . PHP_EOL;
            $tmParent = new ProductTM();
            $tmParent
                ->setParentId($_ENV['PRODUCT_TM'])
                ->setKey($code)
                ->setCode($code)
                ->setPublished(true);
            if ($tmParent->save()) {
                echo 'Saved new TM when handle product ' . $code . PHP_EOL;
            }
        } else {
            echo 'Found product TM when handle product : ' . $code . PHP_EOL;
        }
    }
}

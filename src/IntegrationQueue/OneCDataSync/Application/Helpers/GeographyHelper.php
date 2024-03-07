<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 26.02.2021 10:24
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;


use Pimcore\Model\DataObject\ProductGeography;

class GeographyHelper
{
    public static function checkIfGeographyExist(string $geoCode)
    {
        $geoParent = ProductGeography::getByCode($geoCode, ['limit' => 1]);
        if (empty($geoParent)) {
            echo 'Create new geo when handle product: ' . $geoCode . PHP_EOL;
            $geoParent = new ProductGeography();
            $geoParent
                ->setParentId($_ENV['PRODUCT_GEOGRAPHY_ID'])
                ->setKey($geoCode)
                ->setCode($geoCode)
                ->setPublished(true);
            if ($geoParent->save()) {
                echo 'Saved new geo when handle product ' . $geoCode . PHP_EOL;
            }
        }
        else {
            echo 'Found product geo when handle product : ' . $geoCode . PHP_EOL;
        }
        return $geoParent;
    }
}

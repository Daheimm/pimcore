<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 26.02.2021 12:25
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;


use Pimcore\Model\DataObject\WineCountryClass;

class WineCountryHelper
{
    /**
     * @param string $wineCode
     * @return WineCountryClass|WineCountryClass\Listing
     * @throws \Exception
     */
    public static function checkIfWineCountryExist(string $wineCode)
    {
        $wineCountryClass = WineCountryClass::getByRef($wineCode, ['limit' => 1]);
        if (empty($wineCountryClass)) {
            echo 'Create new wineCountryClass when handle product: ' . $wineCode . PHP_EOL;
            $wineCountryClass = new WineCountryClass();
            $wineCountryClass
                ->setParentId($_ENV['WINE_COUNTRY_ID'])
                ->setKey($wineCode)
                ->setRef($wineCode)
                ->setPublished(true);
            if ($wineCountryClass->save()) {
                echo 'Saved new wineCountryClass when handle product ' . $wineCode . PHP_EOL;
            }
        }
        else {
            echo 'Found product wineCountryClass when handle product : ' . $wineCode . PHP_EOL;
        }
        return $wineCountryClass;
    }
}

<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 26.02.2021 13:24
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;


use Pimcore\Model\DataObject\WineJoin;

class WineJoinHelper
{
    /**
     * @param string $wineJoinCode
     * @return WineJoin|WineJoin\Listing
     * @throws \Exception
     */
    public static function checkIfWineExist(string $wineJoinCode)
    {
        $wineJoin = WineJoin::getByRef($wineJoinCode, ['limit' => 1]);
        if (empty($wineJoin)) {
            echo 'Create new wineJoin when handle product: ' . $wineJoinCode . PHP_EOL;
            $wineJoin = new WineJoin();
            $wineJoin
                ->setParentId($_ENV['WINE_JOIN_ID'])
                ->setKey($wineJoinCode)
                ->setRef($wineJoinCode)
                ->setPublished(true);
            if ($wineJoin->save()) {
                echo 'Saved new wineJoin when handle product ' . $wineJoinCode . PHP_EOL;
            }
        }
        else {
            echo 'Found product wineJoin when handle product : ' . $wineJoinCode . PHP_EOL;
        }
        return $wineJoin;
    }
}

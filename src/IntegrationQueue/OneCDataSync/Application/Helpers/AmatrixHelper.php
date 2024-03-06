<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 05.10.2021 8:58
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;

use Pimcore\Model\DataObject\Amatrix;

class AmatrixHelper
{
    public static function checkIfAmatrixExist(string $matrixCode)
    {
        $amatrix = Amatrix::getByRef($matrixCode, ['limit' => 1]);
        if (empty($amatrix)) {
            echo 'Create new amatrix when handle product: ' . $matrixCode . PHP_EOL;
            $amatrix = new Amatrix();
            $amatrix
                ->setParentId($_ENV['AMATRIX_DIR'])
                ->setKey($matrixCode)
                ->setRef($matrixCode)
                ->setPublished(true);
            if ($amatrix->save()) {
                echo 'Saved new amatrix ' . $matrixCode . PHP_EOL;
            }
        } else {
            echo 'Found product amatrix : ' . $matrixCode . PHP_EOL;
        }
        return $amatrix;
    }


    public static function buildRegAmatrixCode(string $productGUID, string $amatrixGUID)
    {
        return md5($productGUID . $amatrixGUID);
    }
}

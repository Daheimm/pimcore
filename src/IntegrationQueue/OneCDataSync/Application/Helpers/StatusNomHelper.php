<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 25.05.2021 9:28
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;


use Pimcore\Model\DataObject\StatusNom;

class StatusNomHelper
{
    public static function checkIfStatusNomExist(string $numRef)
    {
        $nom = StatusNom::getByRef($numRef, ['limit' => 1]);
        if (empty($nom)) {
            echo 'Create new nom when handle product: ' . $numRef . PHP_EOL;
            $nom = new StatusNom();
            $nom
                ->setParentId($_ENV['STATUS_NOM_DIR'])
                ->setKey($numRef)
                ->setRef($numRef)
                ->setPublished(true);
            if ($nom->save()) {
                echo 'Saved new nom when handle product ' . $numRef . PHP_EOL;
            }
        }
        else {
            echo 'Found status nom when handle product : ' . $numRef . PHP_EOL;
        }
        return $nom;
    }
}

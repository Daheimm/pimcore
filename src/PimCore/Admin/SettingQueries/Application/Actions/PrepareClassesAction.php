<?php

namespace App\PimCore\Admin\SettingQueries\Application\Actions;

use App\PimCore\Admin\SettingQueries\Application\Dto\Settings\PimCoreClassesDto;
use Pimcore\Model\DataObject\ClassDefinition;

class PrepareClassesAction
{
    /**
     * @param array $arrays
     * @param int $idIsActive
     *
     * @return array
     */
    public static function run(array $arrays, ?int $idIsActive = 0)
    {
        $newArr = [];
        /**
         * @var ClassDefinition $item
         */
        foreach ($arrays as $item) {
            $prepareClass = (new PimCoreClassesDto())
                ->setId($item->getId())
                ->setName($item->getName())
                ->setActive(false);

            if ($idIsActive == $item->getId()) {
                $prepareClass->setActive(true);
            }

            $newArr[] = $prepareClass;
        }

        return $newArr;
    }
}

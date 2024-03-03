<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\ClassesPimCoreServiceInterface;
use Pimcore\Model\DataObject\ClassDefinition\Listing;

class ClassesPimCoreService implements ClassesPimCoreServiceInterface
{
    /**
     * @return array
     */
    public function getAll(): array
    {
        $classesList = new Listing();
        $classesList->setOrderKey('name');
        $classesList->setOrder('asc');

        $classes = $classesList->load();

        return $classes;
    }
}

<?php

namespace App\PimCore\Products\Application\Services\Interfaces\Exports;

use Pimcore\Model\DataObject\Product;

interface ExportDataModifierServiceInterface
{
    public function injectFieldsIntoExport(array $objectData,array $fields,bool $returnMappedFieldNames);
}

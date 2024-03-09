<?php

namespace App\PimCore\ProductInfo\Products\Application\Services\Interfaces\Exports;

interface ExportDataModifierServiceInterface
{
    public function injectFieldsIntoExport(array $objectData, array $fields, bool $returnMappedFieldNames);
}

<?php

namespace App\PimCore\Products\Application\Services\Interfaces\Exports;

interface ExportDataModifierServiceInterface
{
    public function injectFieldsIntoExport(array $objectData, array $fields, bool $returnMappedFieldNames);
}

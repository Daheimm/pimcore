<?php

namespace App\PimCore\Products\Application\Services\Exports;

use App\PimCore\Products\Application\Actions\Exports\RetrieveFieldLabelByKey;
use App\PimCore\Products\Application\Enums\Exports\FieldsIntoExportEnum;
use App\PimCore\Products\Application\Services\Interfaces\Exports\ExportDataModifierServiceInterface;
use Pimcore\Model\DataObject\Product;

class ExportDataModifierService implements ExportDataModifierServiceInterface
{
    public function injectFieldsIntoExport(array $objectData, array $fields, bool $returnMappedFieldNames): array
    {
        $keys = array_map(fn($case) => $case->value, FieldsIntoExportEnum::cases());

        foreach ($keys as $key) {
            if ($returnMappedFieldNames) {
                $key = RetrieveFieldLabelByKey::run($fields, $key);
            }
            $objectData[$key] = substr($objectData[$key], strrpos($objectData[$key], '/') + 1);
        }
        return $objectData;
    }
}

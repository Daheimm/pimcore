<?php

namespace App\PimCore\Products\Application\Actions\Exports;

class RetrieveFieldLabelByKey
{
    /**
     * @param array $fields
     * @param string $key
     *
     * @return string
     */
    public static function run(array $fields, string $key): string
    {
        $keys = array_column($fields, 'key');
        $idx = array_search($key, $keys, true);

        return $fields[$idx]['label'];
    }
}

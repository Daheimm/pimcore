<?php

namespace App\IntegrationQueue\OneCDataSync\Application\Helpers;


class ActualPricesHelper
{
    public static function getValueFromFilters(string $valueName, array $filters)
    {
        foreach ($filters as $filter) {
            if (!empty($filter->Name)
                && !empty($filter->Name->{'#value'})
                && $filter->Name->{'#value'} === $valueName) {
                return $filter->Value->{'#value'};
            }
        }
        return null;
    }

    public static function buildCodeValueForPrice(string $nomValue, string $catPrice)
    {
        return md5($nomValue . $catPrice);
    }
}

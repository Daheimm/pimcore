<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 12.04.2021 15:32
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use App\Helpers\ActualPricesHelper;
use Pimcore\Model\DataObject\ActualPrices;
use Pimcore\Model\DataObject\AMeasureUnits;

class ActualPrice1C extends ActualPrices
{
    /**
     * @var ActualPrices
     */
    protected $actualPrice;
    protected $raw;

    public function __construct($raw, ActualPrices $actualPrices)
    {
        $this->actualPrice = $actualPrices;
        $this->raw = $raw;
    }

    public function from1C(): ActualPrices
    {
        $this->actualPrice->setParentId($_ENV['ACTUAL_PRICE_DIR']);

        $code = ActualPricesHelper::buildCodeValueForPrice($this->raw->Номенклатура, $this->raw->КатегорияЦен);

        $this->actualPrice->setKey($code);
        $this->actualPrice->setCode($code);

        if (!$this->actualPrice->isPublished()) {
            $this->actualPrice->setPublished(true);
        }
        $this->actualPrice->setProduct($this->raw->Номенклатура);

        if (!empty($this->raw->ЕдиницаИзмерения) && $this->raw->ЕдиницаИзмерения !== $_ENV['EMPTY_REF']) {
            $unit = AMeasureUnits::getByRef($this->raw->ЕдиницаИзмерения)->current();
            $this->actualPrice->setAMeasureUnits($unit);
        }

        $this->actualPrice->setPriceCategory($this->raw->КатегорияЦен);
        $this->actualPrice->setPrice($this->raw->Цена);
        return $this->actualPrice;
    }
}

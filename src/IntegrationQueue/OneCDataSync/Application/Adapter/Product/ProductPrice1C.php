<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Carbon\Carbon;
use Pimcore\Model\DataObject\AMeasureUnits;
use Pimcore\Model\DataObject\Prices;

class ProductPrice1C extends Prices
{
    /**
     * @var Prices
     */
    protected $price;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, Prices $price)
    {
        $this->price = $price;
        $this->raw = $raw;
    }

    public function from1C(): Prices
    {
        $this->price->setParentId($_ENV['PRODUCT_PRICE_PARENTID']); // 63111

        if(!$this->price->isPublished()){
            $this->price->setPublished(true);
        }

        $code = md5($this->raw->Номенклатура . $this->raw->ТипЦен . $this->raw->Date . $this->raw->ЕдиницаИзмерения);

        $this->price->setKey($code);

        $this->price->setProduct($this->raw->Номенклатура);
        $this->price->setPrice($this->raw->Цена);

        $am = AMeasureUnits::getByRef($this->raw->ЕдиницаИзмерения)->current();
        $this->price->setAMeasureUnits($am);

        $this->price->setPricetype($this->raw->ТипЦен);
        $this->price->setCurrency($this->raw->Валюта);

        $date = new Carbon($this->raw->Date);
        $this->price->setPrice_date($date);
        $this->price->setCode($code);

        return $this->price;
    }
}

<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\AMeasureUnits;

class ProductMeasureUnits1C extends AMeasureUnits
{

    /**
     * @var AMeasureUnits
     */
    protected $unit;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, AMeasureUnits $unit)
    {
        $this->unit = $unit;
        $this->raw = $raw;
    }

    public function from1C(): AMeasureUnits
    {
        $this->unit->setParentId($_ENV['PRODUCT_MEASURE_PARENTID']); // 63112

        if(!$this->unit->isPublished()){
            $this->unit->setPublished(true);
        }

        //$this->unit->setId($this->raw->Code);
        $this->unit->setKey($this->raw->Ref);

        $this->unit->setRef($this->raw->Ref);
        $owner = (array)$this->raw->Owner;
        $this->unit->setOwner($owner['#value']??$this->raw->Ref);
        $this->unit->setDescription($this->raw->Description);
        $this->unit->setVolume($this->raw->АУ_Объем);
        $this->unit->setCoefficient($this->raw->Коэффициент);

        return $this->unit;
    }

}

<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 26.02.2021 14:59
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\WineCountryClass;

class ProductWineCountry1C extends WineCountryClass
{
    /**
     * @var WineCountryClass
     */
    protected $wineCountry;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, WineCountryClass $wineCountryClass)
    {
        $this->wineCountry = $wineCountryClass;
        $this->raw = $raw;
    }

    public function from1C(): WineCountryClass
    {
        $this->wineCountry->setParentId($_ENV['WINE_COUNTRY_ID']);
        if (!empty($this->raw->Parent) && $this->raw->Parent !== $_ENV['EMPTY_REF']) {
            $this->wineCountry->setParentRef($this->raw->ParentObject);
            $this->wineCountry->setParentId($this->raw->ParentFolderId);
        }

        if (!$this->wineCountry->isPublished()) {
            $this->wineCountry->setPublished(true);
        }
        $this->wineCountry->setDeletionMark($this->raw->DeletionMark);
        $this->wineCountry->setKey($this->raw->Ref);
        $this->wineCountry->setRef($this->raw->Ref);
        $this->wineCountry->setDescription($this->raw->Description);
        $this->wineCountry->setClassification($this->raw->НаименованиеПолное);
        return $this->wineCountry;
    }
}

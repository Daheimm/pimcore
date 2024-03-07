<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 05.02.2021 10:35
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\ProductGeography;

class ProductGeography1C extends ProductGeography
{
    /**
     * @var ProductGeography
     */
    protected $productGeography;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, ProductGeography $productTM)
    {
        $this->productGeography = $productTM;
        $this->raw = $raw;
    }

    public function from1C(): ProductGeography
    {
        $this->productGeography->setParentId($_ENV['PRODUCT_GEOGRAPHY_ID']);
        if (!empty($this->raw->Parent) && $this->raw->Parent !== $_ENV['EMPTY_REF']) {
            $this->productGeography->setParentCode($this->raw->Parent);
            $this->productGeography->setParentId($this->raw->ParentFolderId);
        }

        if (!$this->productGeography->isPublished()) {
            $this->productGeography->setPublished(true);
        }
        $this->productGeography->setKey($this->raw->Ref);
        $this->productGeography->setCode($this->raw->Ref);
        $this->productGeography->setName($this->raw->Description);
        $this->productGeography->setName($this->raw->Наименование_ua, 'uk');
        $this->productGeography->setName($this->raw->Наименование_en, 'en');
        return $this->productGeography;
    }
}

<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 04.02.2021 23:34
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\ProductTM;

class ProductTM1C extends ProductTM
{
    /**
     * @var ProductTM
     */
    protected $productTM;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, ProductTM $productTM)
    {
        $this->productTM = $productTM;
        $this->raw = $raw;
    }

    public function from1C(): ProductTM
    {
        $this->productTM->setParentId($_ENV['PRODUCT_TM']);
        if (!empty($this->raw->Parent) && $this->raw->Parent !== $_ENV['EMPTY_REF']) {
            $this->productTM->setParentCode($this->raw->Parent);
            $this->productTM->setParentId($this->raw->ParentFolderId);
        }

        if (!$this->productTM->isPublished()) {
            $this->productTM->setPublished(true);
        }
        $this->productTM->setDel_mark($this->raw->DeletionMark);
        $this->productTM->setKey($this->raw->Ref);
        $this->productTM->setCode($this->raw->Ref);
        $this->productTM->setTM($this->raw->Description);
        $this->productTM->setTM($this->raw->Наименование_ua, 'uk');
        $this->productTM->setTM($this->raw->Наименование_en, 'en');
        return $this->productTM;
    }
}

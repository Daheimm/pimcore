<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 31.08.2021 11:52
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use Pimcore\Model\DataObject\ProductFacilityAddress;

class ProductFacilityAddress1C extends ProductFacilityAddress
{
    /**
     * @var ProductFacilityAddress
     */
    protected $productFacilityAddress;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, ProductFacilityAddress $ProductFacilityAddress)
    {
        $this->productFacilityAddress = $ProductFacilityAddress;
        $this->raw = $raw;
    }

    public function from1C(): ProductFacilityAddress
    {
        $this->productFacilityAddress->setParentId($_ENV['PRODUCT_FACILITY_ADDRESS_DIR']);
        if (!empty($this->raw->Parent) && $this->raw->Parent !== $_ENV['EMPTY_REF']) {
            $this->productFacilityAddress->setParentRef($this->raw->ParentObject);
            $this->productFacilityAddress->setParentId($this->raw->ParentFolderId);
        }

        if (!$this->productFacilityAddress->isPublished()) {
            $this->productFacilityAddress->setPublished(true);
        }
        $this->productFacilityAddress->setIsFolder($this->raw->IsFolder);
        $this->productFacilityAddress->setKey($this->raw->Ref);
        $this->productFacilityAddress->setRef($this->raw->Ref);
        $this->productFacilityAddress->setCode($this->raw->Code);
        $this->productFacilityAddress->setDeletionMark($this->raw->DeletionMark);
        $this->productFacilityAddress->setName($this->raw->Description);
        $this->productFacilityAddress->setAddress($this->raw->Адрес);
        $this->productFacilityAddress->setCountry($this->raw->CountryObject);
        $this->productFacilityAddress->setProducer($this->raw->ProducerObject);
        return $this->productFacilityAddress;
    }
}

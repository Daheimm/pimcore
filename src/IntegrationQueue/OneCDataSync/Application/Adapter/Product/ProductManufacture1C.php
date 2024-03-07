<?php
/**
 * User: Anton Melnichyk
 * Email: melnichyk_anton@exeline.info
 * Date: 05.02.2021 10:23
 */

namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\ProductManufacturer;

class ProductManufacture1C extends ProductManufacturer
{
    /**
     * @var ProductManufacturer
     */
    protected $productManufacturer;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, ProductManufacturer $productTM)
    {
        $this->productManufacturer = $productTM;
        $this->raw = $raw;
    }

    public function from1C(): ProductManufacturer
    {
        $this->productManufacturer->setParentId($_ENV['PRODUCT_MANUFACTURE_ID']);

        if (!$this->productManufacturer->isPublished()) {
            $this->productManufacturer->setPublished(true);
        }
        $this->productManufacturer->setCode($this->raw->Ref);
        $this->productManufacturer->setKey($this->raw->Ref);
        $this->productManufacturer->setName($this->raw->Description);
        return $this->productManufacturer;
    }
}

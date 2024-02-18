<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use App\Adapter\Product\ProductDepartment;
use Pimcore\Model\DataObject\ProductNomClass1;

class ProductNomClass11C extends \Pimcore\Model\DataObject\ProductNomClass1
{

    /**
     * @var ProductDepartment
     */
    protected $n1;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, ProductNomClass1 $n1)
    {
        $this->n1 = $n1;
        $this->raw = $raw;
    }

    public function from1C(): ProductNomClass1
    {

        $this->n1->setParentId($_ENV['PRODUCT_NOM_1']);
        if(!$this->n1->isPublished()){
            $this->n1->setPublished(true);
        }
        $this->n1->setKey($this->raw->Ref);
        $this->n1->setCode($this->raw->Ref);
        $this->n1->setDelMark($this->raw->DeletionMark);
        $this->n1->setIsFolder($this->raw->IsFolder);
        $this->n1->setParentCode($this->raw->Parent);
        $this->n1->setName($this->raw->Description);
        $this->n1->setName($this->raw->Наименование_ua, 'uk-UA');
        $this->n1->setName($this->raw->Наименование_en, 'en-US');
        return $this->n1;
    }

}

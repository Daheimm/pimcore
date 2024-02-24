<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\ProductDepartment;

class ProductDepartment1C extends \Pimcore\Model\DataObject\ProductDepartment
{

    /**
     * @var ProductDepartment
     */
    protected $department;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, ProductDepartment $department)
    {
        $this->department = $department;
        $this->raw = $raw;
    }

    public function from1C(): ProductDepartment
    {

        $this->department->setParentId($_ENV['PRODUCT_DEPARTMENT_PARENTID']);
        if(!$this->department->isPublished()){
            $this->department->setPublished(true);
        }
        $this->department->setKey(trim(str_replace([' ', '/', '\\'], ['_','_','_'], $this->raw->Description)));
        $this->department->setCode($this->raw->Ref);
        $this->department->setName($this->raw->Description);
        return $this->department;
    }

}

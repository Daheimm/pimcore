<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;

use Pimcore\Model\DataObject\ProductDescription;
use Pimcore\Model\DataObject\ProductDescriptionType;

class ProductDescription1C extends ProductDescription
{
    /**
     * @var ProductDescription
     */
    protected $description;
    protected $raw;
    protected $language = 'uk-UA';

    private $fuc = [
        'setProduct' => ['key' => ['field' => 'Номенклатура'], 'require' => true],
        'setDescriptionType' => ['key' => ['field' => 'ВидОписания'], 'require' => true],
        'setDesription' => ['key' => ['field' => 'Описание'], 'require' => false],
    ];

    public function __construct($raw, ProductDescription $description)
    {
        $this->description = $description;
        $this->raw = $raw;
    }

    public function from1C(): ProductDescription
    {
        if($this->description->getParent() == null){
            $this->description->setParentId($_ENV['PRODUCT_DESCRIPTION_PARENTID']);
        }

        if(!$this->description->isPublished()){
            $this->description->setPublished(true);
        }

        foreach ($this->fuc as $func => $params) {
            if($func == 'setProduct'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->description->setProduct($this->raw->{$params['key']['field']});
                    continue;
                }
            }
            if($func == 'setDescriptionType'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $type = ProductDescriptionType::getByCode($this->raw->{$params['key']['field']});
                    $this->description->setDescriptionType($type->current());
                    continue;
                }
            }
            if($func == 'setDesription'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->description->setDesription($this->raw->{$params['key']['field']});
                    continue;
                }
            }
        }

        return $this->description;
    }

}

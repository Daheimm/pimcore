<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\ProductDescriptionType;

class ProductDescriptionType1C extends ProductDescriptionType
{
    /**
     * @var ProductDescriptionType
     */
    protected $type;
    protected $raw;
    protected $language = 'uk-UA';

    private $fuc = [
        //'setCode' => ['key' => ['field' => 'Code'], 'require' => true],
        'setCode' => ['key' => ['field' => 'Ref'], 'require' => true],
        'setDel_mark' => ['key' => ['field' => 'DeletionMark'], 'require' => true],
        'setDescription' => ['key' => ['field' => 'Description'], 'require' => false],
    ];

    public function __construct($raw, ProductDescriptionType $type)
    {
        $this->type = $type;
        $this->raw = $raw;
    }

    public function from1C(): ProductDescriptionType
    {
        if($this->type->getParent() == null){
            $this->type->setParentId($_ENV['PRODUCT_DESCRIPTION_TYPE_PARENTID']);
        }

        if(!$this->type->isPublished()){
            $this->type->setPublished(true);
        }

        $this->type->setLang($this->raw->Язык);

        foreach ($this->fuc as $func => $params) {
            if($func == 'setCode'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->type->setCode($this->raw->{$params['key']['field']});
                    $this->type->setKey($this->raw->{$params['key']['field']});
                    continue;
                }
            }
            if($func == 'setDel_mark'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->type->setDel_mark($this->raw->{$params['key']['field']});
                    continue;
                }
            }
            if($func == 'setDescription'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->type->setDescription($this->raw->{$params['key']['field']});
                    continue;
                }
            }
        }

        return $this->type;
    }

}

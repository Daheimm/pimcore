<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\ProductBarcode;

class ProductBarcode1C extends ProductBarcode
{
    /**
     * @var ProductBarcode
     */
    protected $barcode;
    protected $raw;
    protected $language = 'uk-UA';

    private $fuc = [
        'setProduct' => ['key' => ['field' => 'Номенклатура'], 'require' => true],
        'setBarcode' => ['key' => ['field' => 'ШтрихКод'], 'require' => true],
        'setBarcode_type' => ['key' => ['field' => 'АУ_ВидШтрихКода'], 'require' => false],
        'setBarcode_main' => ['key' => ['field' => 'АУ_Основной'], 'require' => false],
        'setBarcode_notForSale' => ['key' => ['field' => 'АУ_НеДляПродажи'], 'require' => false],
    ];

    public function __construct($raw, ProductBarcode $barcode)
    {
        $this->barcode = $barcode;
        $this->raw = $raw;
    }

    public function from1C(): ProductBarcode
    {
        if($this->barcode->getParent() == null){
            $this->barcode->setParentId($_ENV['PRODUCT_BARCODE_PARENTID']);
        }

        if(!$this->barcode->isPublished()){
            $this->barcode->setPublished(true);
        }

        foreach ($this->fuc as $func => $params) {
            if($func == 'setProduct'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->barcode->setProduct($this->raw->{$params['key']['field']});
                    continue;
                }
            }
            if($func == 'setBarcode'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->barcode->setBarcode($this->raw->{$params['key']['field']});
                    continue;
                }
            }
            if($func == 'setBarcode_type'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->barcode->setBarcode_type($this->raw->{$params['key']['field']});
                    continue;
                }
            }
            if($func == 'setBarcode_main'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->barcode->setBarcode_main($this->raw->{$params['key']['field']});
                    continue;
                }
            }
            if($func == 'setBarcode_notForSale'){
                if(!empty($params['key']['field']) && !empty($this->raw->{$params['key']['field']})){
                    $this->barcode->setBarcode_notForSale($this->raw->{$params['key']['field']});
                    continue;
                }
            }
        }

        return $this->barcode;
    }

}

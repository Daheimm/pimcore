<?php


namespace App\IntegrationQueue\OneCDataSync\Application\Adapter\Product;


use Pimcore\Model\DataObject\Data\ExternalImage;
use Pimcore\Model\DataObject\ProductPictures;

class ProductPictures1C extends \Pimcore\Model\DataObject\ProductPictures
{
    /**
     * @var ProductPictures
     */
    protected $picture;
    protected $raw;
    protected $language = 'uk-UA';

    public function __construct($raw, ProductPictures $picture)
    {
        $this->picture = $picture;
        $this->raw = $raw;
    }

    public function from1C(): ProductPictures
    {
        if(empty($this->picture->getParentId())){
            $this->picture->setParentId($_ENV['PRODUCT_PICTURE_PARENTID']);
        }

        if($this->picture->isPublished() == false){
            $this->picture->setPublished(true);
        }

        $this->picture->setProduct($this->raw->Номенклатура);
        $this->picture->setKey($this->raw->Номенклатура);

        if(preg_match('/\.jpg$/', trim($this->raw->URL))){
            $picture = new ExternalImage($this->raw->URL);
            $this->picture->setLinkJpg($picture);
        }

        if(preg_match('/\.png$/', trim($this->raw->URL))){
            $picture = new ExternalImage($this->raw->URL);
            $this->picture->setLinkPng($picture);
        }

        return $this->picture;
    }
}

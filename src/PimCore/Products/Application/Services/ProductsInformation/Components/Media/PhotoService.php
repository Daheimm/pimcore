<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components\Media;

use App\PimCore\Products\Application\Services\ProductsInformation\Components\ComponentsAbstract;
use Pimcore\Model\DataObject\Data\Hotspotimage;
use Pimcore\Model\DataObject\Product;

class PhotoService extends ComponentsAbstract
{
    public function proccess(Product $product): array
    {
        $arr =null;
        try {
            /**
             * @var Hotspotimage $mediaClass
             */
            $mediaClass = $product->get(Product::FIELD_FOTOPRODUCT);

            if (!$mediaClass) {
                return [];
            }
            $arr["image"] = $mediaClass->getImage()->getLowQualityPreviewPath();

        } catch (\Exception $e) {
            $this->logger->error($e);
        }
        return $arr;
    }
}

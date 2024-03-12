<?php

namespace App\PimCore\ProductInfo\Products\Application\Strategies;


use App\PimCore\Admin\SettingQueries\Infrastructure\Facades\QueueSettings\PimcoreQueueSettingsFacade;
use App\PimCore\ProductInfo\Products\Application\Actions\Prepares\LoadDataToArrayAction;
use App\PimCore\ProductInfo\Products\Application\Messages\ProductMessage;
use App\Shared\Application\Dto\ObjectDatas\ObjectDataDto;


use App\Shared\Application\Facades\RabbitMQ\RabbitMQFacade;
use Pimcore\Model\DataObject\Product;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;

class ProductStrategy implements ProcessingStrategyInterface
{
    public function process(ObjectDataDto $objectDataDto)
    {
        $dataSettingsForQueue = PimcoreQueueSettingsFacade::getSettings($objectDataDto);

        $dataForQueue = LoadDataToArrayAction::run($dataSettingsForQueue);

        RabbitMQFacade::dispatch(new ProductMessage($dataForQueue),
            [
                new AmqpStamp(ProductMessage::ROUTE_KEY),
            ]
        );
    }

    /**
     * @param string $className
     * @return bool
     */
    public function support(string $className): bool
    {
        return Product::class === $className;
    }
}

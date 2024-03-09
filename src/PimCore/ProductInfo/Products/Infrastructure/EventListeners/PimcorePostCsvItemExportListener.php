<?php

namespace App\PimCore\ProductInfo\Products\Infrastructure\EventListeners;

use App\PimCore\ProductInfo\Products\Application\Services\Interfaces\Exports\ExportDataModifierServiceInterface;
use Pimcore\Event\DataObjectEvents;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Model\DataObject\Product;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: DataObjectEvents::POST_CSV_ITEM_EXPORT, method: 'onPostCsvItemExport')]
final class PimcorePostCsvItemExportListener
{
    public function __construct(
        private readonly ExportDataModifierServiceInterface $dataModifierService,
        private readonly LoggerInterface $logger)
    {
    }

    public function onPostCsvItemExport(DataObjectEvent $event)
    {
        $context = $event->getArgument('context');

        if (!($context['source'] === 'pimcore-export' && $event->getObject() instanceof Product)) {
            return;
        }

        try {
            $objectData = $event->getArgument('objectData');
            $fields = $event->getArgument('fields');
            $returnMappedFieldNames = $event->getArgument('returnMappedFieldNames');

            // Виклик сервісу для ін'єкції оптимізації полів
            $modifiedData = $this->dataModifierService->injectFieldsIntoExport($objectData, $fields, $returnMappedFieldNames);

            $event->setArgument('objectData', $modifiedData);
        } catch (\Exception $exception) {
            $this->logger->critical($exception);
        }
    }
}

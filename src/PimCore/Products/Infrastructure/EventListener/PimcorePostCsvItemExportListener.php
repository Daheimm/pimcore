<?php

namespace PimCore\Products\Infrastructure\EventListener;

use Pimcore\Event\DataObjectEvents;
use Pimcore\Event\Model\DataObjectEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: DataObjectEvents::POST_CSV_ITEM_EXPORT, method: 'onPostCsvItemExport')]
final class PimcorePostCsvItemExportListener
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    /**
     * Get field label by key
     */
    private function getFieldLabelByKey(array $fields, string $key): string
    {
        $keys = array_column($fields, 'key');
        $idx = array_search($key, $keys, true);
        $label = $fields[$idx]['label'];

        return $label;
    }

    /**
     * Arguments:
     *  - objectData | array | contains the export data of the object
     *  - context | array | context information - default ['source' => 'pimcore-export']
     *  - requestedLanguage | string | requested language
     *  - helperDefinitions | array | containing the column definition from the grid view
     *  - localeService | \Pimcore\Localization\LocaleService
     *  - returnMappedFieldNames | bool | if "true" the objectData is an associative array, otherwise it is an indexed array
     */
    public function onPostCsvItemExport(DataObjectEvent $event)
    {
        $context = $event->getArgument('context');
        if ($context['source'] !== 'pimcore-export') {
            return;
        }

        $keys = [
            'measureelations',      // Базова Од. вимірювання
            'alternativeuom',       // Альтернативна Од. вимірювання
            'manufacturerelatoin',  // Виробник
            'countrurelations',     // Країна виробництва
            'brandrelations',       // Бренд
            'countrubrand',         // Країна бренду
            'lineproductrelatoin',  // Лінія продукту
            'rootcatrelations',     // Категорія (1 рівень)
            'categoriesrelations',  // Категорія (2 рівень)
            'variantrelations',     // Варіант (3 рівень)
            'subcategoryrelation',  // Субкатегорія (3 рівень)
        ];
        $objectData = $event->getArgument('objectData');
        $fields = $event->getArgument('fields');
        $returnMappedFieldNames = $event->getArgument('returnMappedFieldNames');
        foreach ($keys as $key) {
            if ($returnMappedFieldNames) {
                $key = $this->getFieldLabelByKey($fields, $key);
            }

            $objectData[$key] = substr($objectData[$key], strrpos($objectData[$key], '/') + 1);
        }
        $event->setArgument('objectData', $objectData);
    }
}

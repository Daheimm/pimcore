<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\QueueSettings;

use App\PimCore\Admin\SettingQueries\Application\Facades\PimCoreQueueSettingsFacade;
use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\Shared\Application\Dto\ObjectDatas\ObjectDataDto;

class PimcoreQueueSettings
{
    /**
     * @param ObjectDataDto $objectDataDto
     * @return array
     */
    public function getSettings(ObjectDataDto $objectDataDto): array
    {
        $queriesGeneral = PimCoreQueueSettingsFacade::findByTypeIdWithEmptyEndpoint($objectDataDto->getClassDefinitionId());
        $queriesSpecific = PimCoreQueueSettingsFacade::findByTypeIdAndPath($objectDataDto->getClassDefinitionId(), $objectDataDto->getPathFolder());

        return $this->replacePlaceholderWithId(array_merge($queriesGeneral, $queriesSpecific), $objectDataDto->getId());

    }

    /**
     * @param array<GraphqlRequestsPimcore> $dataSettings
     * @param int $id
     * @return array
     */
    private function replacePlaceholderWithId(array $dataSettings, int $id): array
    {
        foreach ($dataSettings as &$setting) {
            $setting->setQuery(str_replace('$$id', $id, $setting->getQuery()));
        }
        return $dataSettings;
    }
}

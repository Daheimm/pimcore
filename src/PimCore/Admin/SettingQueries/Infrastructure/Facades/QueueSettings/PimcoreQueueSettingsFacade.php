<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Facades\QueueSettings;

use App\PimCore\Admin\SettingQueries\Infrastructure\QueueSettings\PimcoreQueueSettings;
use App\Shared\Application\Dto\ObjectDatas\ObjectDataDto;
use Lagdo\Symfony\Facades\AbstractFacade;

/**
 * @method static array getSettings(ObjectDataDto $objectDataDto)
 */
class PimcoreQueueSettingsFacade extends AbstractFacade
{

    /**
     * @inheritDoc
     */
    protected static function getServiceIdentifier(): string
    {
        return PimcoreQueueSettings::class;
    }
}

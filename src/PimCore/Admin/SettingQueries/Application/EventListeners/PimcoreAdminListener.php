<?php

namespace App\PimCore\Admin\SettingQueries\Application\EventListeners;

use Pimcore\Event\BundleManager\PathsEvent;

class PimcoreAdminListener
{
    public function addJSFiles(PathsEvent $event)
    {
        $event->setPaths(
            array_merge(
                $event->getPaths(),
                [
                    '/admin/rabbitmq/js/menu.js',
                    '/admin/rabbitmq/js/createNewRouteController.js',
                    '/admin/rabbitmq/js/settings.js',
                ]
            )
        );
    }

}

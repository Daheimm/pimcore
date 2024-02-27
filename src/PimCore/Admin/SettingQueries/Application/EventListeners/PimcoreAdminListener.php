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
                    '/admin/rabbitmq/js/configuration/graphql/configItem.js',
                    '/admin/rabbitmq/js/handlers/action.js',
                    '/admin/rabbitmq/js/modals/createType.js',
                    '/admin/rabbitmq/js/adapter/graphql.js',
                    '/admin/rabbitmq/js/menu.js',
                    '/admin/rabbitmq/js/createNewRouteController.js',
                    '/admin/rabbitmq/js/settings.js',
                ]
            )
        );
    }

}

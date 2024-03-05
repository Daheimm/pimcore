<?php

namespace App\PimCore\Products\Application\Services\ProductsInformation\Components;

use Psr\Log\LoggerInterface;

abstract class ComponentsAbstract
{
    protected LoggerInterface $logger;


    /**
     * @required
     * @param LoggerInterface $logger
     * @return void
     */
    private function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

}

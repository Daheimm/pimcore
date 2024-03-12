<?php

namespace App\Shared\Infrastructure\Http;

use React\Http\Browser;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\Service\Attribute\Required;

abstract class HttpGraphQLAsyncAbstract
{

    protected Browser $browser;
    protected readonly ContainerBagInterface $params;

    public function __construct()
    {
        $this->browser = $this->browser->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param ContainerBagInterface $params
     * @return void
     */
    #[Required]
    public function setContainer(ContainerBagInterface $params): void
    {
        $this->params = $params;
    }

    /**
     * @return void
     */
    #[Required]
    public function setBrowser(): void
    {
        $this->browser = new Browser();
    }
}

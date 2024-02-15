<?php

namespace App\PimCore\Receipts\Infrastructure\MessageHandler;


use App\PimCore\Receipts\Application\Messages\GraphQl\RecipeUpdateMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class RecipeMessageHandler implements MessageHandlerInterface
{
    public function __construct()
    {
    }

    public function __invoke(RecipeUpdateMessage $message)
    {
        // TODO: Implement __invoke() method.
    }
}

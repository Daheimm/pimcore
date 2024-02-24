<?php

namespace App\MessageHandler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class SampleMessangeHandler
{
    public function __invoke(SampleMessage $message)
    {
        // magically invoked when an instance of SampleMessage is dispatched
        print_r('Handler handled the message!');
    }
}

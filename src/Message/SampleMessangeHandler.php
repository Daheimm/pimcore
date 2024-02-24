<?php

namespace App\Message;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SampleMessangeHandler implements MessageHandlerInterface
{
    public function __invoke(SampleMessage $message)
    {
        // magically invoked when an instance of SampleMessage is dispatched
        print_r('Handler handled the message!');
    }
}

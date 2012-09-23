<?php

namespace foo;
use dayax\core\Message;

class Foo
{
    public function getMessage()
    {
        return Message::translateMessage('foo');
    }
}
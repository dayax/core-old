<?php

namespace foo\bar\hello;

use dayax\core\Message;

class World
{
    public function getMessage()
    {
        return Message::translateMessage('hello');
    }
}
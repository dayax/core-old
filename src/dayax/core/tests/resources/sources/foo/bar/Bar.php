<?php

namespace foo\bar;

use dayax\core\Message;

class Bar
{
    public function getMessage()
    {
        return Message::translateMessage('bar');
    }
}
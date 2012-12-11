<?php

namespace foo;

class Hello
{
    public function throwException()
    {
        throw new TestException('foo_hello');
    }
}
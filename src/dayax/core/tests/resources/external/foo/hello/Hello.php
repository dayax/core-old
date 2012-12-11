<?php

namespace foo\hello;

class Hello
{
    public function throwException() {
        throw new TestException('foo_hello_hello');
    }
}
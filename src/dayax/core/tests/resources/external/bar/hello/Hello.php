<?php

namespace bar\hello;

class Hello
{
    public function throwException() {
        throw new TestException('bar_hello_hello');
    }
}
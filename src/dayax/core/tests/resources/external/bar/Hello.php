<?php

namespace bar;

class Hello
{
    public function throwException() {
        throw new TestException('bar_hello');
    }
}
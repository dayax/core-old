<?php

/*
 * This file is part of the dayax project.
 *
 * (c) Anthonius Munthi <toni.dayax@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dayax\core\tests;

use dayax\core\test\TestCase;
use dayax\core\Exception;

class FooException extends Exception
{

}

/**
 * ExceptionTest Class.
 *
 * @author Anthonius Munthi <toni.dayax@gmail.com>
 */
class ExceptionTest extends TestCase
{
    public function testTranslateMessage()
    {
        $e = new FooException('foo');
        $this->assertEquals('bar',$e->getMessage());
    }

    public function testLoadClass()
    {
        $this->assertTrue(class_exists('dayax\core\tests\InvalidArgumentException'));
        
    }

    /**
     * 
     * @expectedException           InvalidArgumentException
     * @expectedExceptionMessage   Invalid Argument Exception Message
     */
    public function testThrowInvalidArgumentException()
    {
        throw new InvalidArgumentException('invalid_argument_exception');
    }

    /**
     * @expectedException           LogicException
     */
    public function testThrowLogicException()
    {
        throw new LogicException('logic_exception');
    }
    
    public function testSetExtends()
    {
        $this->markTestIncomplete();
    }
}
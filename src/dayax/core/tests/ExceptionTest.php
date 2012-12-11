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
use dayax\core\Dayax;
require_once __DIR__.'/resources/external_autoload.php';

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
    
    static public function setUpBeforeClass()
    {        
        
        parent::setUpBeforeClass();
    }
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
     * @expectedException          InvalidArgumentException
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
    
    /**
     * @dataProvider    getTestExternalMessage
     */
    public function testTranslateExternalMessage($ob,$expected)
    {                
        $r = new \ReflectionClass($ob);
        $this->setExpectedException($r->getNamespaceName().'\\TestException');
        try{
            $ob->throwException();
        }catch(Exeption $e){
            $this->assertEquals($expected,$e->getMessage());            
        }
    }
    
    public function getTestExternalMessage()
    {
        
        return array(
            array(new \foo\Hello(),'foo hello exception'),
            array(new \foo\hello\Hello(),'foo hello hello exception'),
            array(new \bar\Hello(),'bar hello exception'),
            array(new \bar\hello\Hello(),'bar hello hello exception'),
        );
    }
}
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
use dayax\core\Message;
use dayax\core\Dayax;


/**
 * MessageTest Class.
 *
 * @author Anthonius Munthi <toni.dayax@gmail.com>
 */
class MessageTest extends TestCase
{
    protected function setUp()
    {
    }

    static public function setUpBeforeClass()
    {
        require_once(__DIR__.'/resources/sources/foo/Foo.php');
        require_once(__DIR__.'/resources/sources/foo/bar/Bar.php');
        require_once(__DIR__.'/resources/sources/foo/bar/hello/World.php');
    }

    static public function tearDownAfterClass()
    {
        $cached = Message::getCacheFileName(__DIR__.'/resources/messages/messages.txt');
        $dir = dirname($cached);
        self::remove(dirname(Message::getCacheFileName(__DIR__.'/resources/messages/messages.txt')));
        self::remove(dirname(Message::getCacheFileName(__DIR__.'/resources/sources/foo/resources/messages/messages.txt')));
        self::remove(dirname(Message::getCacheFileName(__DIR__.'/resources/sources/foo/bar/hello/resources/messages/messages.txt')));
    }

    /**
     * @dataProvider getTranslateMessage
     */
    public function testTranslateMessage($key,$expected,$lang='en')
    {
        $params = array($key);
        $args = func_get_args();
        if(count($args)>3){
            $i = 3;
            while(isset($args[$i])){
                $params[] = $args[$i];
                $i++;
            }
        }
        $defLang = Message::getLanguage();
        Message::setLanguage($lang);
        $this->assertEquals($expected,Message::translateMessage($params));
        Message::setLanguage($defLang);
    }

    public function getTranslateMessage()
    {
        return array(
            array('foo','bar'),
            array('foo','translated foo','id'),
            array('foo.bar','foo Foo bar Bar','en','Foo','Bar'),
        );
    }

    public function testTranslateMessageFromObject()
    {        
        Dayax::getLoader()->add('foo', array(__DIR__.'/resources/sources'));
        
        $foo = new \foo\Foo();
        $this->assertEquals('Foo',$foo->getMessage());

        $bar = new \foo\bar\Bar();
        $this->assertEquals('Bar',$bar->getMessage());

        $world = new \foo\bar\hello\World();
        //print_r(Dayax::getLoader()->findFile(get_class($world)));
        //$this->assertEquals(__DIR__,Dayax::getPathOfNamespace(get_class($world)));
        $this->assertEquals('Hello World!',$world->getMessage());
    }

}
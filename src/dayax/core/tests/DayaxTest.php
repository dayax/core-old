<?php

namespace dayax\core\tests;
use dayax\core\Dayax;
use dayax\core\test\TestCase;
require_once __DIR__.'/resources/external_autoload.php';

class DayaxTest extends TestCase
{
    public function testGetPathOfNamespace()
    {        
        $this->assertTrue(is_dir(Dayax::getPathOfNamespace('dayax\\core\\tests')),'test get path of tests class');        
        $this->assertTrue(is_file(Dayax::getPathOfNamespace('dayax\\core\\test\TestCase')),'test get path of TestCase Class');
        
        $this->assertTrue(is_dir(Dayax::getPathOfNamespace('foo\\resources\\messages')));
        $this->assertTrue(is_dir(Dayax::getPathOfNamespace('bar\\resources\\messages')));
    }
    
    public function testGetLoader()
    {
        $this->assertTrue(is_object(Dayax::getLoader()));
    }
    
}
?>

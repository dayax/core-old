<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use dayax\core\Dayax;
use dayax\core\Exception;

$l = Dayax::getLoader();
$l->add('foo', __DIR__.'/external');
$l->add('bar', __DIR__.'/external');

Exception::addPackage('foo');
Exception::addPackage('bar');
?>

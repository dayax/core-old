<?php
$loader = require_once __DIR__.'/vendor/autoload.php';
$loader->register();

use dayax\core\Exception;
Exception::registerAutoload();
?>

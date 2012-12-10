<?php
/*
 * This file is part of the dayax project.
 *
 * (c) Anthonius Munthi <toni.dayax@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$loader = require_once __DIR__ . '/vendor/autoload.php';
$loader->register();
dayax\core\Dayax::setLoader($loader);
dayax\core\Exception::registerAutoload();
?>
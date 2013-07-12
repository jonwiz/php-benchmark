<?php
/**
 * PHP-Benchmark - A comparison benchmarking utility
 *
 * @author Troy McCabe <troy@dydro.com>
 * @copyright 2013 Dydro LLC. All rights reserved.
 * @license BSD 3-Clause License
 * @link http://github.com/dydro/php-benchmark
 * @package Dydro\Benchmark
 */

namespace Dydro\Sample;

use Dydro\Benchmark\Benchmark;
use Dydro\Benchmark\Manager;

require_once(__DIR__ . '/../vendor/autoload.php');

// create all your comparison benchmarks
$a = new Benchmark('A first product');
$b = new Benchmark('A shorter product');
$c = new Benchmark('Something else entirely');

// create the manager and add them all
$manager = new Manager();
$manager->addBenchmarks([$a, $b, $c]);

// do some random work
$a->start();
for ($i = 0; $i < 10; $i++) $$i = $i;
$a->stop();

$b->start();
for ($j = 0; $j < 100; $j++) $$j = $j;
$b->stop();

$c->start();
for ($k = 0; $k < 1000; $k++) $$k = $k;
$c->stop();

// get the results
$dir = __DIR__ . '/out/';
if (!is_dir($dir)) {
    mkdir($dir);
}
file_put_contents($dir . '02.html', $manager->getResults('Sample 02 Results -- HTML', Manager::FORMAT_HTML));
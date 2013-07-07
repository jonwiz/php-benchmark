<?php
/**
 * PHP-Benchmark - A comparison benchmarking utility
 *
 * @author Troy McCabe <troy@dydro.com>
 * @copyright 2013 Dydro LLC. All rights reserved.
 * @license BSD 3-Clause License
 * @link http://github.com/dydro/php-benchmark
 * @package Dydro\Benchmark\Tests
 */

namespace Dydro\Benchmark\Test;

use Dydro\Benchmark\Benchmark;
use Dydro\Benchmark\Manager;

/**
 * Tests for the manager class
 *
 * @package Dydro\Benchmark\Tests
 */
class ManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of a manager for testing
     *
     * @var Manager
     */
    protected $manager;

    /**
     * Sets up for tests
     */
    public function setUp()
    {
        $this->manager = new Manager();
    }

    /**
     * Tests adding benchmarks to the manager
     */
    public function testAddBenchmarks()
    {
        $b = new Benchmark('bleh');
        $this->manager->addBenchmarks([$b]);

        $this->assertAttributeCount(1, 'benchmarks', $this->manager);
    }

    /**
     * Tests getting cli results
     */
    public function testGetCliResults()
    {
        $a = new Benchmark('ach');
        $b = new Benchmark('bleh');
        $c = new Benchmark('chhh');
        $this->manager->addBenchmarks([$a, $b, $c]);

        $a->start();
        for ($i = 0; $i < 10; $i++) $$i = $i;
        $a->stop();

        $b->start();
        for ($j = 0; $j < 100; $j++) $$j = $j;
        $b->stop();

        $c->start();
        for ($k = 0; $k < 1000; $k++) $$k = $k;
        $c->stop();

        $this->manager->getResults('html', Manager::FORMAT_HTML);
        $results = $this->manager->getResults('Testaroo');
        // replace the colors so we can actually test
        $results = preg_replace('/\\033\[\d{1,2}m/m', '', $results);

$expected = <<<EOD

+--------------------------------------------------------+
|                                                        |
|             BENCHMARK RESULTS -- Testaroo              |
|                                                        |
+-------------------+----------------+-------------------+
|      PRODUCT      |    TIME (s)    |    MEMORY (kB)    |
+-------------------+----------------+-------------------+
EOD;

        $this->assertStringStartsWith($expected, $results);
    }

    /**
     * Tests getting html results
     */
    public function testGetHtmlResults()
    {
        $a = new Benchmark('ach');
        $this->manager->addBenchmark($a);

        $results = $this->manager->getResults('Ach!', Manager::FORMAT_HTML);

$expected = <<<EOD
<!doctype html>
<html>
    <head>
        <title>BENCHMARK RESULTS -- Ach!</title>
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <style>#dy-benchmark-results * {text-align: center;}</style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <table class="table table-striped table-hover table-bordered" id="dy-benchmark-results">
                        <thead>
                            <tr>
                                <th colspan="3">BENCHMARK RESULTS -- Ach!</th>
                            </tr>
                            <tr>
                                <th>PRODUCT</th>
                                <th>TIME (s)</th>
                                <th>MEMORY (kB)</th>
                            </tr>
                        </thead>
                        <tbody>
EOD;

        $this->assertStringStartsWith($expected, $results);

    }
}
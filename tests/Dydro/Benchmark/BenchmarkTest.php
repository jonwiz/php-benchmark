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

/**
 * Tests for the benchmark class
 *
 * @package Dydro\Benchmark\Tests
 */
class BenchmarkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of a benchmark for testing
     *
     * @var Benchmark
     */
    protected $benchmark;

    /**
     * Sets up for tests
     */
    public function setUp()
    {
        $this->benchmark = new Benchmark('test');
    }

    /**
     * Tests getting the memory used
     */
    public function testGetMemory()
    {
        $b = new Benchmark('bleh');
        $b->start();
        for ($i = 0; $i < 100; $i++) $$i = $i;
        $b->stop();

        $this->assertGreaterThan(1, $b->getMemory());
    }

    /**
     * Tests getting the product name
     */
    public function testGetProductName()
    {
        $this->assertEquals('test', $this->benchmark->getProductName());
    }

    /**
     * Tests getting the time elapsed
     */
    public function testGetTime()
    {
        $b = new Benchmark('bleh');
        $b->start();
        sleep(1);
        $b->stop();

        $this->assertGreaterThan(1, $b->getTime());
    }

    /**
     * Tests starting the timer
     */
    public function testStart()
    {
        $this->benchmark->start();

        $this->assertAttributeGreaterThan(0, 'startTime', $this->benchmark);
        $this->assertAttributeGreaterThan(0, 'startMemory', $this->benchmark);
    }

    /**
     * Tests stopping the timer
     */
    public function testStop()
    {
        $this->benchmark->stop();

        $this->assertAttributeGreaterThan(0, 'endTime', $this->benchmark);
        $this->assertAttributeGreaterThan(0, 'endMemory', $this->benchmark);
    }
}
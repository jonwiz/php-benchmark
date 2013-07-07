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

namespace Dydro\Benchmark;

/**
 * The Benchmark class
 *
 * @package Dydro\Benchmark
 */
class Benchmark
{
    /**
     * The memory usage at the end of the run
     *
     * @var int
     */
    protected $endMemory = 0;

    /**
     * The time at the end of the run
     *
     * @var int
     */
    protected $endTime = 0;

    /**
     * The name of the product to benchmark
     *
     * @var string
     */
    protected $productName;

    /**
     * The memory usage at the start of the run
     *
     * @var int
     */
    protected $startMemory = 0;

    /**
     * The time at the start of the run
     *
     * @var int
     */
    protected $startTime = 0;

    /**
     * Create a benchmark
     *
     * @param string $productName
     */
    public function __construct($productName)
    {
        $this->productName = $productName;
    }

    /**
     * Stop the benchmark
     */
    public function stop()
    {
        $this->endMemory = memory_get_usage();
        $this->endTime = microtime(true);
    }

    /**
     * Gets the memory usage of the run (in kB)
     *
     * @return float
     */
    public function getMemory()
    {
        return round(($this->endMemory - $this->startMemory) / 1024, 2);
    }

    /**
     * Gets the product name
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Gets the total run time
     *
     * @return float
     */
    public function getTime()
    {
        return round($this->endTime - $this->startTime, 5);
    }

    /**
     * Start a run
     */
    public function start()
    {
        $this->startTime = microtime(true);
        $this->startMemory = memory_get_usage();
    }
}
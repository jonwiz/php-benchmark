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
     * What color to make the memory measurement
     *
     * @var int
     */
    protected $memoryColor = Manager::COLOR_RED;

    /**
     * The name of this benchmark
     *
     * @var string
     */
    protected $name;

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
     * What color to make the time measurement
     *
     * @var int
     */
    protected $timeColor = Manager::COLOR_RED;

    /**
     * Create a benchmark
     *
     * @param string $productName
     */
    public function __construct($productName)
    {
        $this->name = $productName;
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
     * Gets the memory color
     *
     * @return int
     */
    public function getMemoryColor()
    {
        return $this->memoryColor;
    }

    /**
     * Gets the product name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Gets the time color
     *
     * @return int
     */
    public function getTimeColor()
    {
        return $this->timeColor;
    }

    /**
     * @param int $memoryColor
     */
    public function setMemoryColor($memoryColor)
    {
        $this->memoryColor = $memoryColor;
    }

    /**
     * @param int $timeColor
     */
    public function setTimeColor($timeColor)
    {
        $this->timeColor = $timeColor;
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
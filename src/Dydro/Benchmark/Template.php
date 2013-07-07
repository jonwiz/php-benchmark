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
 * An interface for templates to implement
 *
 * @package Dydro\Benchmark
 */
interface Template
{
    /**
     * Gets the footer for display
     *
     * @return string
     */
    public function getFooter();

    /**
     * Gets the header for display
     *
     * @param string $title The title of the table
     * @return string
     */
    public function getHeader($title);

    /**
     * Gets a row for display
     *
     * @param string $name
     * @param float $time
     * @param float $memory
     * @return mixed
     */
    public function getRow($name, $time, $memory);

    /**
     * Makes the inputted text green
     *
     * @param string $text The text to make green
     * @return string
     */
    public function green($text);

    /**
     * Makes the inputted text red
     *
     * @param string $text The text to make red
     * @return string
     */
    public function red($text);

    /**
     * Makes the inputted text yellow
     *
     * @param string $text The text to make yellow
     * @return string
     */
    public function yellow($text);
}
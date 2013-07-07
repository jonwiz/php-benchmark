<?php
/**
 * PHP-Benchmark - A comparison benchmarking utility
 *
 * @author Troy McCabe <troy@dydro.com>
 * @copyright 2013 Dydro LLC. All rights reserved.
 * @license BSD 3-Clause License
 * @link http://github.com/dydro/php-benchmark
 * @package Dydro\Benchmark\Template
 */

namespace Dydro\Benchmark\Template;

use Dydro\Benchmark\Template;

/**
 * CLI Template for display
 *
 * @package Dydro\Benchmark\Template
 */
class Cli implements Template
{
    /**
     * Gets the footer for display
     *
     * @return string
     */
    public function getFooter()
    {
        return PHP_EOL;
    }

    /**
     * Gets the header for display
     *
     * @param string $title The title of the table
     * @return string
     */
    public function getHeader($title)
    {
        $output = PHP_EOL;
        $output .= '+--------------------------------------------------------+' . PHP_EOL;
        $output .= '|                                                        |' . PHP_EOL;
        $output .= '|' . $this->bold(str_pad('BENCHMARK RESULTS -- ' . $title, 56, ' ', STR_PAD_BOTH)) . '|' . PHP_EOL;
        $output .= '|                                                        |' . PHP_EOL;
        $output .= '+-------------------+----------------+-------------------+' . PHP_EOL;
        $output .= '|      ' . $this->bold('PRODUCT') . '      ';
        $output .= '|    ' . $this->bold('TIME (s)') . '    ';
        $output .= '|    ' . $this->bold('MEMORY (kB)') . '    |' . PHP_EOL;
        $output .= '+-------------------+----------------+-------------------+' . PHP_EOL;

        return $output;
    }

    /**
     * Gets a row for display
     *
     * @param string $name
     * @param float $time
     * @param float $memory
     * @return mixed
     */
    public function getRow($name, $time, $memory)
    {
        $output = '|' . str_pad($name, 19, ' ', STR_PAD_BOTH);
        $output .= '|' . str_pad($time, 25, ' ', STR_PAD_BOTH);
        $output .= '|' . str_pad($memory, 28, ' ', STR_PAD_BOTH) . '|' . PHP_EOL;
        $output .= '+-------------------+----------------+-------------------+' . PHP_EOL;

        return $output;
    }

    /**
     * Makes the inputted text green
     *
     * @param string $text The text to make green
     * @return string
     */
    public function green($text)
    {
        return "\033[32m{$text}\033[0m";
    }

    /**
     * Makes the inputted text red
     *
     * @param string $text The text to make red
     * @return string
     */
    public function red($text)
    {
        return "\033[31m{$text}\033[0m";
    }

    /**
     * Makes the inputted text yellow
     *
     * @param string $text The text to make yellow
     * @return string
     */
    public function yellow($text)
    {
        return "\033[33m{$text}\033[0m";
    }

    /**
     * Bolds the inputted text
     *
     * @param string $text The text to bold
     * @return string
     */
    protected function bold($text)
    {
        return "\033[1m{$text}\033[0m";
    }
}
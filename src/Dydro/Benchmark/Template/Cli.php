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
use Symfony\Component\Console\Helper\TableHelper;

/**
 * CLI Template for display
 *
 * @package Dydro\Benchmark\Template
 */
class Cli extends Template
{

    /**
     * Gets the header for display
     *
     * @param string $title The title of the table
     * @return string
     */
    public function getResults($title)
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
        $output .= $this->rows . PHP_EOL;

        return $output;
    }

    /**
     * Adds data to the table
     *
     * @param string $name
     * @param float $time
     * @param float $memory
     * @return void
     */
    public function addRow($name, $time, $memory)
    {
        $output = '|' . str_pad($name, 19, ' ', STR_PAD_BOTH);
        $output .= '|' . str_pad($time, 25, ' ', STR_PAD_BOTH);
        $output .= '|' . str_pad($memory, 28, ' ', STR_PAD_BOTH) . '|' . PHP_EOL;
        $output .= '+-------------------+----------------+-------------------+' . PHP_EOL;

        $this->rows .= $output;
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
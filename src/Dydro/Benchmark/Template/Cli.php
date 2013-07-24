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

use Dydro\Benchmark\Benchmark;
use Dydro\Benchmark\Manager;
use Dydro\Benchmark\Template;

/**
 * CLI Template for display
 *
 * @package Dydro\Benchmark\Template
 */
class Cli extends Template
{

    /**
     * Gets the results
     *
     * @param string $title The title of the table
     * @return string
     */
    public function getResults($title)
    {
        // calculate our widths based on the rows we have
        $productWidth = 15;
        $timeWidth = 15;
        $memoryWidth = 15;

        // find the longest items in each column
        /** @var Benchmark $row */
        foreach ($this->rows as $row) {
            $productLength = strlen(' ' . $row->getName() . ' ');
            $timeLength = strlen(' ' . $row->getTime() . ' ');
            $memoryLength = strlen(' ' . $row->getMemory() . ' ');

            // if the calculate lengths are longer than the longest one, that's going to be our max going forward
            if ($productLength > $productWidth) {
                $productWidth = $productLength;
            }
            if ($timeLength > $timeWidth) {
                $timeWidth = $timeLength;
            }
            if ($memoryLength > $memoryWidth) {
                $memoryWidth = $memoryLength;
            }
        }

        // sum them (the 2 is the addition of the extra chars on either side)
        $totalWidth = $productWidth + $timeWidth + $memoryWidth + 2;

        // build the table
        $output = PHP_EOL;
        // The main header (with the title)
        $output .= '+' . str_repeat('-', $totalWidth) . '+' . PHP_EOL;
        $output .= '|' . str_repeat(' ', $totalWidth) . '|' . PHP_EOL;
        $output .= '|' . $this->bold(str_pad($title, $totalWidth, ' ', STR_PAD_BOTH)) . '|' . PHP_EOL;
        $output .= '|' . str_repeat(' ', $totalWidth) . '|' . PHP_EOL;
        // The sub header (the column headers)
        $output .= '+' . str_repeat('-', $productWidth);
        $output .= '+' . str_repeat('-', $timeWidth);
        $output .= '+' . str_repeat('-', $memoryWidth) . '+' . PHP_EOL;
        $output .= '|' . $this->bold(str_pad('PRODUCT', $productWidth, ' ', STR_PAD_BOTH));
        $output .= '|' . $this->bold(str_pad('TIME (s)', $timeWidth, ' ', STR_PAD_BOTH));
        $output .= '|' . $this->bold(str_pad('MEMORY (kB)', $memoryWidth, ' ', STR_PAD_BOTH)) . '|' . PHP_EOL;
        $output .= '+' . str_repeat('-', $productWidth);
        $output .= '+' . str_repeat('-', $timeWidth);
        $output .= '+' . str_repeat('-', $memoryWidth) . '+' . PHP_EOL;
        // The rows
        foreach ($this->rows as $row) {
            // pad & colorize the time
            $timeText = str_pad($row->getTime(), $timeWidth, ' ', STR_PAD_BOTH);
            $timeText = $this->getColoredText($timeText, $row->getTimeColor());

            // pad & colorize the memory usage
            $memoryText = str_pad($row->getMemory(), $memoryWidth, ' ', STR_PAD_BOTH);
            $memoryText = $this->getColoredText($memoryText, $row->getMemoryColor());

            // preing the actual row for this benchmark
            $output .= '|' . str_pad($row->getName(), $productWidth, ' ', STR_PAD_BOTH);
            $output .= '|' . $timeText;
            $output .= '|' . $memoryText . '|' . PHP_EOL;
            $output .= '+' . str_repeat('-', $productWidth);
            $output .= '+' . str_repeat('-', $timeWidth);
            $output .= '+' . str_repeat('-', $memoryWidth) . '+' . PHP_EOL;
        }

        return $output . PHP_EOL;
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
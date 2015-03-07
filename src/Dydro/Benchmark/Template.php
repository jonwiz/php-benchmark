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
abstract class Template
{
    /**
     * The rows for the table
     *
     * @var string
     */
    protected $rows = [];

    /**
     * Adds data to the table
     *
     * @param Benchmark $benchmark
     * @return void
     */
    public function addRow(Benchmark $benchmark)
    {
        $this->rows[] = $benchmark;
    }

    /**
     * Returns the colored version of the text based on the requested color code
     *
     * @param string $text
     * @param int $color
     * @return string
     */
    protected function getColoredText($text, $color)
    {
        switch ($color) {
            case Manager::COLOR_GREEN:
                $return = $this->green($text);
                break;

            case Manager::COLOR_YELLOW:
                $return = $this->yellow($text);
                break;

            default:
            case Manager::COLOR_RED:
                $return = $this->red($text);
                break;
        }

        return $return;
    }

    /**
     * Gets the header for display
     *
     * @param string $title The title of the table
     * @return string
     */
    abstract public function getResults($title);

    /**
     * Makes the inputted text green
     *
     * @param string $text The text to make green
     * @return string
     */
    abstract public function green($text);

    /**
     * Makes the inputted text red
     *
     * @param string $text The text to make red
     * @return string
     */
    abstract public function red($text);

    /**
     * Makes the inputted text yellow
     *
     * @param string $text The text to make yellow
     * @return string
     */
    abstract public function yellow($text);
}
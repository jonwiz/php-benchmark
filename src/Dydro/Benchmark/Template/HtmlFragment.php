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
use Dydro\Benchmark\Template;

/**
 * HTML Fragment Template for display
 *
 * @package Dydro\Benchmark\Template
 */
class HtmlFragment extends Template
{
    /**
     * Gets the results
     *
     * @param string $title The title of the table
     * @return string
     */
    public function getResults($title)
    {
        $rows = '';
        /** @var Benchmark $row */
        foreach ($this->rows as $row) {
            // colorize the time
            $timeText = $this->getColoredText($row->getTime(), $row->getTimeColor());

            // colorize the memory usage
            $memoryText = $this->getColoredText($row->getMemory(), $row->getMemoryColor());

            // append an html row
            $rows .= "<tr><td>{$row->getName()}</td><td>{$timeText}</td><td>{$memoryText}</td></tr>";
        }
$output = <<<EOD
<table class="table table-striped table-hover table-bordered dy-benchmark-results">
    <thead>
        <tr>
            <th colspan="3">{$title}</th>
        </tr>
        <tr>
            <th>PRODUCT</th>
            <th>TIME (s)</th>
            <th>MEMORY (kB)</th>
        </tr>
    </thead>
    <tbody>
        {$rows}
    </tbody>
</table>
EOD;

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
        return "<span class=\"label label-success\">{$text}</span>";
    }

    /**
     * Makes the inputted text red
     *
     * @param string $text The text to make red
     * @return string
     */
    public function red($text)
    {
        return "<span class=\"label label-important\">{$text}</span>";
    }

    /**
     * Makes the inputted text yellow
     *
     * @param string $text The text to make yellow
     * @return string
     */
    public function yellow($text)
    {
        return "<span class=\"label label-warning\">{$text}</span>";
    }
}
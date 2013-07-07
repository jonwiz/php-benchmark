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
 * HTML Template for display
 *
 * @package Dydro\Benchmark\Template
 */
class Html implements Template
{
    /**
     * Gets the footer for display
     *
     * @return string
     */
    public function getFooter()
    {
return <<<EOD
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

EOD;
    }

    /**
     * Gets the header for display
     *
     * @param string $title The title of the table
     * @return string
     */
    public function getHeader($title)
    {
$output = <<<EOD
<!doctype html>
<html>
    <head>
        <title>BENCHMARK RESULTS -- {$title}</title>
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
                                <th colspan="3">BENCHMARK RESULTS -- {$title}</th>
                            </tr>
                            <tr>
                                <th>PRODUCT</th>
                                <th>TIME (s)</th>
                                <th>MEMORY (kB)</th>
                            </tr>
                        </thead>
                        <tbody>

EOD;

        return $output;
    }

    /**
     * Gets a row for display
     *
     * @param string $name The product name
     * @param float $time The time (must be colored already)
     * @param float $memory The memory (must be colored already)
     * @return mixed
     */
    public function getRow($name, $time, $memory)
    {
        return "<tr><td>{$name}</td><td>{$time}</td><td>{$memory}</td></tr>";
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
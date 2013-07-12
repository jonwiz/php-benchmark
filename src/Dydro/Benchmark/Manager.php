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
use Dydro\Benchmark\Template\Cli;
use Dydro\Benchmark\Template\Html;

/**
 * A class to manage multiple benchmarks
 *
 * @package Dydro\Benchmark
 */
class Manager
{
    /**
     * Const for the green color
     */
    const COLOR_GREEN = 0;

    /**
     * Const for the red color
     */
    const COLOR_RED = 1;

    /**
     * Const for the yellow color
     */
    const COLOR_YELLOW = 2;

    /**
     * Format results for CLI
     */
    const FORMAT_CLI = 'cli';

    /**
     * Format results for HTML
     */
    const FORMAT_HTML = 'html';

    /**
     * Benchmarks that we are watching
     *
     * @var Benchmark[]
     */
    protected $benchmarks = [];

    /**
     * Add a benchmark to compare against
     *
     * @param Benchmark $benchmark
     */
    public function addBenchmark(Benchmark $benchmark)
    {
        $this->benchmarks[] = $benchmark;
    }

    /**
     * Add multiple benchmarks
     *
     * @param Benchmark[] $benchmarkArray
     */
    public function addBenchmarks($benchmarkArray)
    {
        foreach ($benchmarkArray as $benchmark) {
            $this->addBenchmark($benchmark);
        }
    }

    /**
     * Gets the results
     *
     * Depending on the SAPI that PHP is currently running in, the results will either be plain text or HTML
     *
     * @param string $name The name to put in the title
     * @param string $format The format of the output
     * @return string
     */
    public function getResults($name, $format = self::FORMAT_CLI)
    {
        // figure out which products should be assigned which colors
        $colors = $this->calculateColors();

        // create the template
        if ($format == self::FORMAT_CLI) {
            $template = new Cli();
        } else {
            $template = new Html();
        }

        // go through each benchmark and color the results properly
        // this is for both time and memory
        // ...I could use variable variables here, but...nah.
        /** @var Benchmark $benchmark */
        foreach ($this->benchmarks as $benchmark) {
            $benchmark->setTimeColor($colors['time'][$benchmark->getName()]);
            $benchmark->setMemoryColor($colors['memory'][$benchmark->getName()]);

            // save the row for this benchmark
            $template->addRow($benchmark);
        }

        // get the display and send it back;
        return $template->getResults($name);
    }

    /**
     * Calculates which benchmark values get which colors
     *
     * @return array
     */
    protected function calculateColors()
    {
        // initial structure of our return array
        $return = ['time' => [], 'memory' => []];

        // short-circuit if we only have one thing to benchmark
        if (count($this->benchmarks) == 1) {
            $name = $this->benchmarks[0]->getName();
            $return['time'][$name] = self::COLOR_GREEN;
            $return['memory'][$name] = self::COLOR_GREEN;

            return $return;
        }

        // we make separate arrays since we don't want to re-order the list as it was passed in. usort would do that
        $times = [];
        $memories = [];

        // split them all out
        /** @var Benchmark $benchmark */
        foreach ($this->benchmarks as $benchmark) {
            $times[$benchmark->getName()] = $benchmark->getTime();
            $memories[$benchmark->getName()] = $benchmark->getMemory();
        }

        // sort them by value
        asort($times);
        asort($memories);

        // go through the times--anything < 34% is green, between 34 and 66 is yellow, higher is red
        $i = 1;
        foreach ($times as $productName => $time) {
            $rank = $i / (count($this->benchmarks) + 1);
            if ($rank <= .34) {
                $return['time'][$productName] = self::COLOR_GREEN;
            } else if ($rank > .34 && $rank <= .66) {
                $return['time'][$productName] = self::COLOR_YELLOW;
            } else {
                $return['time'][$productName] = self::COLOR_RED;
            }
            $i++;
        }

        // go through the memory--anything < 34% is green, between 34 and 66 is yellow, higher is red
        $i = 1;
        foreach ($memories as $productName => $memory) {
            $rank = $i / (count($this->benchmarks) + 1);
            if ($rank <= .34) {
                $return['memory'][$productName] = self::COLOR_GREEN;
            } else if ($rank > .34 && $rank <= .66) {
                $return['memory'][$productName] = self::COLOR_YELLOW;
            } else {
                $return['memory'][$productName] = self::COLOR_RED;
            }
            $i++;
        }

        return $return;
    }
}
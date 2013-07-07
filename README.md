# PHP-Benchmark
A comparison benchmarking utility

PHP-Benchmark is intented to be used to compare libraries, or do small testing in your application

## Installation
Installation should be handled through Composer:
    "require": {
        "dydro/benchmark": "dev-master"
    }

## Usage
Usage is very simple with Benchmark:
    $benchmark = new Benchmark('MyProduct');
    $manager = new Manager();
    $manager->addBenchmark($benchmark);

    $benchmark->start();
    ...do stuff...
    $benchmark->stop();

    echo $manager->getResults('MyProduct test');

## Output
Depending on the environment in which PHP is running (CLI or non-CLI) Benchmark will spit out different responses:

### CLI
    +--------------------------------------------------------+
    |                                                        |
    |           BENCHMARK RESULTS -- 04.images.php           |
    |                                                        |
    +-------------------+----------------+-------------------+
    |      PRODUCT      |    TIME (s)    |    MEMORY (kB)    |
    +-------------------+----------------+-------------------+
    |       FPDF        |    0.01311     |       599.8       |
    +-------------------+----------------+-------------------+
    |       TCPDF       |     0.4036     |     10946.85      |
    +-------------------+----------------+-------------------+

### HTML
    <!doctype html>
    <html>
        <head>
            <title>BENCHMARK RESULTS -- 04.images.php</title>
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
                                    <th colspan="3">BENCHMARK RESULTS -- 04.images.php</th>
                                </tr>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>TIME (s)</th>
                                    <th>MEMORY (kB)</th>
                                </tr>
                            </thead>
                            <tbody>
    <tr><td>FPDF</td><td><span class="label label-success">0.01278</span></td><td><span class="label label-success">599.9</span></td></tr>
    <tr><td>TCPDF</td><td><span class="label label-important">0.39344</span></td><td><span class="label label-important">10946.73</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </body>
    </html>
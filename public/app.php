<?php
error_reporting(E_ALL);
set_time_limit (0);

require __DIR__ . '/../vendor/autoload.php';

use V\ChatV2\App;

try {
    $app = new App();
    $app->run($argv);
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

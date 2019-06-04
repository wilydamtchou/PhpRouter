<?php
require '../vendor/autoload.php';

use Monolog\Logger;
use PhpRouter\App\Kernel;
use PhpRouter\App\Request;
use Monolog\Handler\StreamHandler;

try {
    $appKernel = new Kernel(new Request());
    $appKernel->bootstrapingRequest();
} catch (\Exception $exception) {
    $message = $exception->getTraceAsString();
    echo $message;
    // create a log channel
    $log = new Logger('error');
    $log->pushHandler(new StreamHandler('../logs/log.log', Logger::WARNING));

    $log->error($message);
}

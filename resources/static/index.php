<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Featherweight\Kernel\Kernel;

$kernel = new Kernel();
$kernel->init();
$kernel->run();

<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Handlr\Core\Kernel;
use Handlr\Core\Request;
use Handlr\Core\Response;

$kernel = new Kernel();

$request = Request::fromGlobals();
$response = new Response;

$response = $kernel->getRouter()->dispatch($request, $response);
$response->send();

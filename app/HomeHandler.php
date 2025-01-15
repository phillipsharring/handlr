<?php

declare(strict_types=1);

namespace App;

use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Handlers\Handler;

class HomeHandler implements Handler
{

    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {

        return $response->withJson(['message' => 'hi']);
    }
}

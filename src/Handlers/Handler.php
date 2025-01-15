<?php

declare(strict_types=1);

namespace Handlr\Handlers;

use Handlr\Core\Request;
use Handlr\Core\Response;

interface Handler
{
    public function handle(Request $request, Response $response, array $args, callable $next): Response;
}

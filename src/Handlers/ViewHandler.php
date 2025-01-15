<?php

declare(strict_types=1);

namespace Handlr\Handlers;

use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Views\View;

class ViewHandler implements Handler
{
    public function __construct(public string $templatePath, public ?array $data = []) {}

    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {
        return $response->withBody(new View($this->templatePath, $this->data)->render());
    }
}

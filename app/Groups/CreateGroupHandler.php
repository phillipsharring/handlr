<?php

declare(strict_types=1);

namespace App\Groups;

use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Handlers\Handler;

readonly class CreateGroupHandler implements Handler
{
    public function __construct(private GroupsTable $groupsTable) {}

    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {
        $group = new GroupRecord($request->getParsedBody());
        $this->groupsTable->insert($group);
        return $response->withJson($group->toArray(), 201);
    }
}

<?php

declare(strict_types=1);

namespace App\Auth;

use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Handlers\Handler;
use JsonException;

readonly class SignupUserHandler implements Handler
{
    public function __construct(private UsersTable $usersTable) {}

    /**
     * @throws JsonException
     */
    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {
        var_dump(__METHOD__);

        $data = $request->getParsedBody();

        $userRecord = new UserRecord($data);
        $this->usersTable->insert($userRecord);

        return $response->withJson(['success' => true], 200);
    }
}

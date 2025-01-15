<?php

declare(strict_types=1);

namespace App\Auth;

use Handlr\Core\Request;
use Handlr\Core\Response;
use Handlr\Handlers\Handler;
use Handlr\Session\Session;
use JsonException;

readonly class LoginUserHandler implements Handler
{
    public function __construct(private UsersTable $usersTable) {}

    /**
     * @throws JsonException
     */
    public function handle(Request $request, Response $response, array $args, callable $next): Response
    {
        $data = $request->getParsedBody();
        unset($data['password']);

        $user = $this->usersTable->findFirst($data);
        Session::start();
        Session::set('user', $user);

        return $response->withJson(['success' => true], 200);
    }
}
